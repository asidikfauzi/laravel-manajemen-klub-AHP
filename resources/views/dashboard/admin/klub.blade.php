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
<h2>DATA KLUB AFKAB SUMENEP 2021-2024</h2>
<button type="submit" onclick="window.location.href='{{route('registerKlub')}}'" class="btn btn-primary">TAMBAH KLUB</button>
<br><br>
<table>
    <tr>
        <th>Image</th>
        <th>Nama Klub</th>
        <th>Controller</th>
    </tr>
    @foreach ($data as $klub)
    <tr>
        <td><img src="{{asset('assets/img/klub/'.$klub['img'])}}" class="rounded mx-auto d-block" alt="image klub" style="height: 50px;"></td>
        <td>{{$klub['nama_klub']}}</td>
        <td><button type="submit" onclick="window.location.href='{{route('editKlub', $klub['id'])}}'" class="btn btn-primary">EDIT</button>
            <button type="submit" onclick="window.location.href='{{route('editKlub', $klub['id'])}}'" class="btn btn-danger">DELETE</button>
        </td>  
    </tr>
  @endforeach
</table>
</section>
</body>
</html>

@endsection
