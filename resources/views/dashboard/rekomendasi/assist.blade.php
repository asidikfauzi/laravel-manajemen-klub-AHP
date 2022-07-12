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
<h2>JUMLAH ASSIST PEMAIN AFKAB SUMENEP 2021-2024</h2>
<br><br>
<div class="row aos-init aos-animate" data-aos="fade-up">
    <div class="col-xl-12 stretch-card-center grid-margin">
        <h5 class="mt-3">PEMAIN</h5>
        <table>
            <tr>
                <th>No.</th>
                <th>Nama Pemain</th>
                <th>Musim</th>
                <th>Nama Klub</th>
                <th>Jumlah Poin</th>
            </tr>
            @foreach ($data as $item)
            <tr>
                <td>{{$loop->index +1}}</td>
                <td>{{$item['nama_pemain']}}</td>
                <td>{{$item['musim']}}</td>
                <td>{{$item['nama_klub']}}</td>
                <td>{{$item['jumlah_assist']}}</td>
            </tr>    
            @endforeach
            
        </table>
    </div>
</div>


</section>
</body>
</html>

@endsection
