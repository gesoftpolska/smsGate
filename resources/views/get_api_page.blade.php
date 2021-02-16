@extends('layouts.app')

@section('content')
<br><br>
    <div class="row" >
        <div class="col-lg-12">
            <p class="h4">Twój API token:</p>
            <p class="h5">{{$user->api_token}}</p>
        </div>

    </div>
<br><br>
<div class="row">
    <div class="col-lg-12">
        <p class="h5">Pobieranie listy stworzonych sms dla aplikacji do wysyłania smsów</p>
        <p >{{asset('/api/get_created_list?api_token=[nazwatokena]')}}</p>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <p class="h5">Aktualizacja statusu</p>
        <p >{{asset('/api/update_status?api_token=[nazwatokena]&text=[tresc wiadomosci]&phone=[numertelefonu]')}}</p>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <p class="h5">Tworzenie nowego smsa</p>
        <p >{{asset('/api/create_sms?api_token=API_TOKEN&phone=123456789&text=abcd&from=od_osoby')}}</p>
    </div>

</div>



@endsection`
