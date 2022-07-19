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

<h2>REKOMENDASI PEMAIN TERBAIK MENURUT AFKAB SUMENEP</h2>
<div class="row aos-init aos-animate" data-aos="fade-up">
    <div class="col-xl-6 stretch-card-center grid-margin">
        <button type="submit" onclick="window.location.href='{{route('klub.showRekomendasi')}}'" class="btn btn-primary" >Cari Pemain Pilihan</button>
        <h5 class="mt-3">PEMAIN</h5>
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
        <button type="submit" onclick="window.location.href='{{route('klub.showRekomendasi.kiper')}}'" class="btn btn-primary" >Cari Kiper Pilihan</button>
        <h5 class="mt-3" >KIPER</h5>
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
