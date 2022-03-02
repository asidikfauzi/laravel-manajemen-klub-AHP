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
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('failed'))
  <div class="alert alert-danger">
      {{ session('failed') }}
  </div>
@endif
        <div class="row">
            <div class="col-sm-2" style="border: 2px solid black;">
                <h2 class="text text-center">INBOX</h2>
                <center>
                    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalSave">COMPOSE</button>
                </center>
                <center>
                    <button  onclick="window.location.href='{{route('klub.messageAdmin')}}'" class="btn btn-secondary col-sm-12 mb-1">Inbox</button>
                </center>
                <center>
                    <button onclick="window.location.href='{{route('klub.sentMessageAdmin')}}'" class="btn btn-secondary col-sm-12">Sent</button>
                </center>
            </div>
            <div class="col-sm-10" style="border: 2px solid black;">
                <table>
                    <tr>
                        <th>From</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                    @foreach ($data as $message)
                    <tr>
                        <td>{{$message['dari_username']}}</td>
                        <td style="text-align: left;">{{$message['isi_pesan']}}. . .</td>
                        <td>{{date('d-m-Y', strtotime($message['created_at']))}}</td>
                        <td><button class="btn btn-primary" onclick="window.location.href='{{route('klub.showOpenMessage', $message['id'])}}'" >Open</button></td>
                    </tr>  
                    @endforeach
                    
                    
                </table>
            </div>
        </div>

        

          <!-- Modal -->
          <form action="{{route('klub.sentMessage')}}" method="POST">
            @csrf
          <div class="modal right fade" id="exampleModalSave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                </div>
                <div class="modal-body">
                   
                        <div class="mb-3">
                          <label for="recipient-name" class="col-form-label">To:</label>
                          <input type="text" name="to" id="to" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="message-text" class="col-form-label">Message:</label>
                          <textarea class="form-control" id="message-text" name="isi_pesan"></textarea>
                        </div>
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">SEND</button>
                </div>
                </div>
            </div>
          </div>
        </form>
        

</section>

@endsection