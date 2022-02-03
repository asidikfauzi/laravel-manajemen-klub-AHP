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
<button type="submit" onclick="window.location.href='{{route('addStrukturKlub',$data[0]['klub_id'])}}'" class="btn btn-primary">TAMBAH STRUKTUR KLUB</button>
<br><br>
<table>
    <tr>
        <th>Image</th>
        <th>Nama </th>
        <th>Jabatan</th>
        <th>Controller</th>
    </tr>
    @foreach ($data as $struktur)
    <tr>
        <td><img src="{{asset('assets/img/struktur/'.$struktur['img'])}}" class="rounded mx-auto d-block" alt="image struktur" style="height: 50px;"></td>
        <td>{{$struktur['nama_sk']}}</td>
        <td>{{$struktur['jabatan']}}</td>
        <td><button type="submit" onclick="window.location.href='{{route('editPemain', $struktur['id'])}}'" class="btn btn-primary">EDIT</button>
            <form action="{{ route('deletePemain', $struktur['id']) }}" method="POST">
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
