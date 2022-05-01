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
<h2>DATA POIN PEMAIN AFKAB SUMENEP 2021-2024</h2>
<br>
<div class="row aos-init aos-animate" data-aos="fade-up">
    <div class="col-xl-6 stretch-card-center grid-margin">
        <h5>PEMAIN</h5>
        <table>
            <tr>
                <th>No.</th>
                <th>Nama Pemain</th>
                <th>Musim</th>
                <th>Nama Klub</th>
                <th>Jumlah Poin</th>
            </tr>
            @foreach ($hasilFinish as $data)
            <tr>
                <td>{{$loop->index +1}}</td>
                <td>{{$data['nama_pemain']}}</td>
                <td>{{$data['musim']}}</td>
                <td>{{$data['nama_klub']}}</td>
                <td>{{$data['jumlah']}}</td>
            </tr>    
            @endforeach
            
        </table>
    </div>
    <div class="col-xl-6 stretch-card-center grid-margin">
        <h5>KIPER</h5>
        <table>
            <tr>
                <th>No.</th>
                <th>Nama Pemain</th>
                <th>Musim</th>
                <th>Nama Klub</th>
                <th>Jumlah Poin</th>
            </tr>
            @foreach ($hasilFinishKiper as $dataKiper)
            <tr>
                <td>{{$loop->index +1}}</td>
                <td>{{$dataKiper['nama_pemain']}}</td>
                <td>{{$dataKiper['musim']}}</td>
                <td>{{$dataKiper['nama_klub']}}</td>
                <td>{{$dataKiper['jumlah']}}</td>
            </tr>
            @endforeach
        </table>    
    </div>    
</div>


</section>
</body>
</html>

@endsection
