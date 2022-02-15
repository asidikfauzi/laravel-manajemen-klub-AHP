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

tr:nth-child(even) {
  background-color: #dddddd;

}
</style>

<section class="page-section">
        <div class="row">
            <div class="col-sm-2" style="border: 2px solid black;">
                <h2 class="text text-center">PESAN</h2>
                <center>
                    <button class="btn btn-primary mb-2">COMPOSE</button>
                </center>
                <center>
                    <button  onclick="window.location.href='{{route('messageAdmin')}}'" class="btn btn-secondary col-sm-12">Inbox</button>
                </center>
                <center>
                    <button onclick="window.location.href='{{route('sentMessageAdmin')}}'" class="btn btn-secondary col-sm-12">Sent</button>
                </center>
            </div>
            <div class="col-sm-10" style="border: 2px solid black;">
                <table>
                    <tr>
                        <th>From</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                    </tr>
                    @foreach ($data as $message)
                    <tr>
                        <td>{{$message['dari_username']}}</td>
                        <td style="text-align: left;">{{$message['isi_pesan']}}. . .</td>
                        <td>{{$message['created_at']}}</td>
                    </tr>  
                    @endforeach
                    
                    
                </table>
            </div>
        </div>

</section>

@endsection