@extends('layouts.app')

@section('content')
    <div class="container">
        {{$content}}
        <div style="font-size: 50px" id="chat_place" class="col-lg-12">

        </div>
        <div class="col-lg-12">
            <input type="text" id="message">
            <button id="sendbutton" value="Wyślij">Wyślij</button>
        </div>

    </div>


    <script>


        var exampleSocket = new WebSocket("wss://www.example.com/socketserver", ["protocolOne", "protocolTwo"]);
        // exampleSocket.send("Here's some text that the server is urgently awaiting!");
        exampleSocket.onopen = function (event) {
            exampleSocket.send("Here's some text that the server is urgently awaiting!");
        };

    </script>


    {{--<script type="text/javascript">--}}


        {{--var zadanie = {--}}
            {{--"zadanie": "nowy_status",--}}
            {{--"nowy_status": "<b>dostarczono</b>",--}}
            {{--"id": "1126",--}}
        {{--};--}}

        {{--let json = JSON.stringify(zadanie);--}}
        {{--var conn = new WebSocket('ws://188.210.221.65:8097');--}}
        {{--conn.onopen = function (e) {--}}
            {{--console.log("Connection established!");--}}
            {{--conn.send(JSON.stringify({command: "register", userId: 1}));--}}
            {{--conn.send(JSON.stringify({command: "subscribe", channel: "global"}));--}}
            {{--conn.send(JSON.stringify({command: "groupchat", message: json, channel: "global"}));--}}


        {{--};--}}

        {{--conn.onmessage = function (e) {--}}

            {{--let id_number = 1129;--}}
            {{--let id_element = "status" + id_number;--}}

            {{--$("#" + id_element).html(e.data);--}}

            {{--console.log(e.data);--}}
        {{--};--}}


    {{--</script>--}}

<!--   --><?php
//   use App\Events\ActionEvent;
//   event(new ActionEvent(2, "cos tam"));
//
//
//   ?>


@endsection
