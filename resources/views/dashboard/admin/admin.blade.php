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
<h2>DATA ADMIN AFKAB SUMENEP 2021-2024</h2>
<button type="submit" onclick="window.location.href='{{route('registerAdmin')}}'" class="btn btn-primary">TAMBAH ADMIN</button>
<br><br>
<table>
    <tr>
        <th>Username</th>
        <th>Controller</th>
    </tr>
    @foreach ($data as $admin)
    <tr>
        <td>{{$admin['username']}}</td>
        <td>
            <form action="{{ route('deletePemain', $admin['username']) }}" method="POST">
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
