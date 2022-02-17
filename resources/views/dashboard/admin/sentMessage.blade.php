@extends('layouts.public')
@section('content')

<style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

</style>

<section class="page-section">
        <div class="row">
            <div class="col-sm-2" style="border: 2px solid black;">
                <h2 class="text text-center">SENT</h2>
                <center>
                    <button class="btn btn-primary mb-2">COMPOSE</button>
                </center>
                <center>
                    <button  onclick="window.location.href='{{route('messageAdmin')}}'" class="btn btn-secondary col-sm-12 mb-1">Inbox</button>
                </center>
                <center>
                    <button onclick="window.location.href='{{route('sentMessageAdmin')}}'" class="btn btn-secondary col-sm-12">Sent</button>
                </center>
            </div>
            <div class="col-sm-10" style="border: 2px solid black;">
                <table>
                    <tr>
                        <th>To</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                    @foreach ($data as $message)
                    <tr>
                        <td>{{$message['kepada_username']}}</td>
                        <td style="text-align: left;">{{$message['isi_pesan']}}. . .</td>
                        <td>{{date('d-m-Y', strtotime($message['created_at']))}}</td>
                        <td><button class="btn btn-primary">Open</button></td>
                    </tr>  
                    @endforeach
                    
                    
                </table>
            </div>
        </div>

</section>

@endsection