@extends('layouts.app')

@section('content')

    <div class="row">
        <table class="table">
            <th>created</th>
            <th>updated</th>
            <th>Od:</th>
            <th>DO</th>
            <th>treść</th>
            <th>status</th>
            @foreach($sms as $s)
                <tr>
                    <td>{{$s->created_at}}</td>
                    <td>{{$s->updated_at}}</td>
                    <td>{{$s->from}}</td>
                    <td>{{$s->phone}}</td>
                    <td>{{$s->text}}</td>
                    <td>{{$s->status->name}}</td>
                </tr>
            @endforeach

        </table>
        <div  class="col-lg-12 pl-4 ">
            <div class="d-flex justify-content-center">
                {{$sms->links()}}
            </div>

        </div>

    </div>

@endsection`
