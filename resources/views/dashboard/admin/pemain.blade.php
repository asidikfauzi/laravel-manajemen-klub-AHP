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
        <th>Controller</th>
    </tr>
    @foreach ($data as $pemain)
    <tr>
        <td><img src="{{asset('assets/img/pemain/'.$pemain['img'])}}" class="rounded mx-auto d-block" alt="image klub" style="height: 50px;"></td>
        <td>{{$pemain['nama_pemain']}}</td>
        <td>{{$pemain['nama_klub']}}</td>
        <td><button type="submit" onclick="window.location.href='{{route('editPemain', $pemain['id'])}}'" class="btn btn-primary">EDIT</button>
            <form action="{{ route('deletePemain', $pemain['id']) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
        </td>  
    </tr>
  @endforeach
</table>
</section>
</body>
</html>

@endsection
