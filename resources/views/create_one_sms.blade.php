@extends('layouts.app')

@section('content')
    <br><br>
    <div class="row">

<div class="col-lg-6">
    <form action="create_sms" method="post">

        @csrf
        <input type="hidden" name="from" value="admin_form">
        <div class="form-group">
            <label for="exampleInputEmail1">Numer telefonu odbiorcy</label>
            <input type="text" class="form-control" name="phone" aria-describedby="emailHelp" placeholder="Wprowadź numer telefonu">

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Treść wiadomości</label>
            <textarea type="text" class="form-control" name="text" placeholder="Teści wiadomości"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Wyślij</button>
    </form>

</div>






    </div>

@endsection`
