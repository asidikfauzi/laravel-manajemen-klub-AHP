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
                <h2 class="text text-center">INBOX</h2>
                <center>
                    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalSave">COMPOSE</button>
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
          <!-- Modal -->
          <div class="modal right fade" id="exampleModalSave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                          <label for="recipient-name" class="col-form-label">To:</label>
                          <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                          <label for="message-text" class="col-form-label">Message:</label>
                          <textarea class="form-control" id="message-text"></textarea>
                        </div>
                      </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">SEND</button>
                    
                </div>
                </div>
            </div>
          </div>

</section>

@endsection