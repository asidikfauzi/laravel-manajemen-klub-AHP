@extends('layouts.public')
@section('content')


<!DOCTYPE html>
<html>
<head>
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
</head>
<body>
<section class="page-section" id="contact">
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
<h2>DATA PEMAIN AFKAB SUMENEP 2021-2024</h2>
<button type="submit" onclick="window.location.href='{{route('registerPemain')}}'" class="btn btn-primary">TAMBAH PEMAIN</button>
<br><br>
<table>
    <tr>
        <th>Image</th>
        <th>Nama Pemain</th>
        <th>Nama Klub</th>
        <th>Posisi</th>
        <th>Reset Password</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    @foreach ($data as $pemain)
    <tr>
        <td><img src="{{asset('assets/img/pemain/'.$pemain['img'])}}" class="rounded mx-auto d-block" alt="image klub" style="height: 50px;"></td>
        <td>{{$pemain['nama_pemain']}}</td>
        <td>{{$pemain['nama_klub']}}</td>
        <td>{{$pemain['posisi']}}</td>
        <td><button type="submit" onclick="window.location.href='{{route('resetPasswordPemain', $pemain['id'])}}'" class="btn btn-primary"><i class="fa fa-sync"></i></button></td>
        <td><button type="submit" onclick="window.location.href='{{route('adminEditPemain', $pemain['id'])}}'" class="btn btn-primary"><i class="fa fa-cog"></i></button></td>
        <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalSave"><i class="fa fa-trash"></button></td>
        
    </tr>
  @endforeach
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModalSave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Peringatan !</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          Apakah anda yakin ingin menghapus pemain ini ?<br>
          Ini akan menghapus kontrak data pemain.
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="{{ route('deletePemain', $pemain['id']) }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">DELETE</i></button>
        </form>
      </div>
      </div>
  </div>
</div>
</section>
</body>
</html>

@endsection
