@extends('layouts.public')
@section('content')
<style type="text/css">
    
    
    .box{
        width: 600px;
        padding: 20px;

    }
    .top_border{
        padding: 10px;
    }
    .sc-item{
        padding: 10px;
        background: #E6E6FA;
    }
    .about_1{
        padding: 20px;
    }
    .about_lav{
        background: #FFF0F5;
    }
    .about_yea{
        background: #FFF8DC;
    }

    ol{
        list-style-type: circle;
    }
    .b1 {
      width: 17%;
    }
    .b2 {
      width: 3% ;
    }
    .topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
  padding: 20px;
}

.topnav a.active {
  background-color: #032A63;
  padding: 20px;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
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

    <div class="topnav">
        <a class="active" href="#">WELCOME {{$data[0]['nama_pemain']}}</a> 
    </div>
    
    
    <div id="about_faq" class="about_lav" >
    <div class="about_1">
      <form action="{{route('editPemain')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @foreach($data as $pemain)
            <div class="col-sm-4" style="height: 100%;">
                <img src="{{asset('assets/img/pemain/'.$pemain['img'])}}" alt="" style="width:100%;  float:left; height: 100%;  float:left; border: 5px solid black;object-fit: cover;"><br>  
                <center>
                  <h4>EDIT IMAGE</h4>
                </center>
              <input id="image" type="file" class="form-control" name="image" value="{{old('image')}}"> <br><br>
                
            </div>
           
            <div class="col-sm-8" >
                <h2>{{$pemain['nama_pemain']}}</h2>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Tempat, Tgl Lahir</b></label>
                    <div class="col-md-9"> 
                    <label for="posisi" class="col-md-8 col-form-label text-md-right" data-date-format="DD-MM-YYYY"><b>:</b> &nbsp;{{$pemain['tempat']}}, {{$pemain['tgl_lahir']}}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Alamat</b></label>
                    <div class="col-md-8"> 
                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{$pemain['alamat']}}" required autocomplete="alamat">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>No. Telephone</b></label>
                    <div class="col-md-8"> 
                    <input id="notelp" type="text" class="form-control @error('notelp') is-invalid @enderror" name="notelp" value="{{$pemain['notelp']}}" required autocomplete="notelp">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Tinggi</b></label>
                    <div class="col-md-8"> 
                    <input id="tinggi" type="text" class="form-control @error('tinggi') is-invalid @enderror" name="tinggi" value="{{$pemain['tinggi']}}" required autocomplete="tinggi">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Berat</b></label>
                    <div class="col-md-8"> 
                    <input id="berat" type="text" class="form-control @error('berat') is-invalid @enderror" name="berat" value="{{$pemain['berat']}}" required autocomplete="berat">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Status</b></label>
                    <div class="col-md-8"> 
                    <label for="posisi" class="col-md-8 col-form-label text-md-right"><b>:</b> &nbsp;{{$pemain['status']}}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Klub</b></label>
                    <div class="col-md-8"> 
                    <label for="posisi" class="col-md-8 col-form-label text-md-right"><b>:</b> &nbsp;{{$pemain['nama_klub']}}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Posisi</b></label>
                    <div class="col-md-8"> 
                    <label for="posisi" class="col-md-8 col-form-label text-md-right"><b>:</b> &nbsp;{{$pemain['posisi']}}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Kontrak</b></label>
                    <div class="col-md-8"> 
                    <label for="posisi" class="col-md-10 col-form-label text-md-right" data-date-format="DD-MM-YYYY"><b>:</b> &nbsp; {{$pemain['awal_kontrak']}} - {{$pemain['akhir_kontrak']}}</label>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="posisi" class="col-md-3 col-form-label text-md-right"><b>Gaji</b></label>
                  <div class="col-md-8"> 
                  <label for="posisi" class="col-md-10 col-form-label text-md-right"><b>:</b> &nbsp; Rp.{{$pemain['gaji']}}</label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="posisi" class="col-md-3 col-form-label text-md-right">Lihat Kontrak anda <a href="{{asset('assets/img/kontrak/'. $pemain['foto_kontrak'])}}" target="_blank">disini </label>
                </div>
                <div class="col-md-8 offset-md-10">
                  <button type="submit" class="btn btn-primary mt-3">
                      {{ __('SIMPAN') }}
                  </button>
                </div> 
              </div>
            </div>                 
            
            @endforeach
        </div>
      </form>  
      </div>
    </div>


</section>
@endsection