@extends('layouts.app')

@section('content')
    <br>

    <form id="search_form" method="get" action="/">
        <input type="hidden" id="query" name="query">
        @csrf
    </form>
    <div class="row">


        <div class="input-group col-lg-12">
            <input type="text" id="query_field" name="query_field" value="{{request()->get('query')}}"
                   class="form-control" placeholder="Treść, numer lub od kogo"
                   aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" onclick="event.preventDefault();
                $('#query').val($('#query_field').val());
                                                     document.getElementById('search_form').submit();"
                        type="button">Szukaj
                </button>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr style="font-style: italic; font-weight: bold">
                    <td>created</td>
                    <td>updated</td>
                    <td>Od:</td>
                    <td>DO:</td>
                    <td>treść</td>
                    <td>status</td>
                </tr>
                </thead>

                @foreach($sms as $s)
                    <tr>
                        <td>{{$s->created_at}}</td>
                        <td>{{$s->updated_at}}</td>
                        <td>{{$s->from}}</td>
                        <td>{{$s->phone}}</td>
                        <td>{{$s->text}}</td>
                        <td id="status{{$s->id}}">{{$s->status->name}}</td>
                    </tr>
                @endforeach

            </table>
            <div class="col-lg-12 pl-4 ">
                <div class="d-flex justify-content-center">
                    {{$sms->links()}}
                </div>

            </div>
        </div>


        <script>
            $('#query_field').keypress(function (e) {

                if (e.keyCode === 13) {
                    $('#query').val($('#query_field').val());
                    $('#search_form').submit();
                }
            });
        </script>


    </div>

    <script type="text/javascript">

        var socket = io.connect('https://bramka.wow.ovh:5001', {
            secure: true,
            reconnect: true,
            rejectUnauthorized: false
        });
        socket.on('connect', function () {
            console.log('Podłączono');
            socket.emit(JSON.stringify({command: "subscribe", channel: "global"}));
            socket.emit(JSON.stringify({command: "groupchat", message: "hello glob", channel: "global"}));

            connected = true;
        });


        socket.on('broadcast', function (data) {
            console.log(data);


            var id_number = 1129;
            let id_element = "status" + id_number;

            try {
                if (data.description != null) {

                    let obj = JSON.parse(data.description);
                    id_number = obj.id;
                    let zadanie = obj.zadanie;

                    switch (zadanie) {
                        case "nowy_status":
                            let id_number = obj.id;
                            let nowy_status = obj.status;
                            $("#status" + id_number).html(nowy_status);

                            break;
                        case "nowy_rekord":
                            var obj2 = {
                                "id": obj.id,
                                "created_at": obj.created_at,
                                "updated_at": obj.updated_at,
                                "from": obj.from,
                                "to": obj.to,
                                "text": obj.text,
                                "status": obj.status
                            };

                            $('table > tbody > tr:first').before('<tr style="background: yellowgreen"><td>' + obj2.created_at + '</td><td>' + obj2.updated_at + '</td><td>' + obj2.from + '</td><td>' + obj2.to + '</td><td>' + obj2.text + '</td><td id="status' + obj2.id + '"><strong>' + obj2.status + '</strong></td></tr>');

                            break;
                    }

                    $("#status" + id_number).html(obj.nowy_status);



                    console.log(data);
                }
            } catch (e) {
                console.log(e);
            }



        });


    </script>




@endsection`
