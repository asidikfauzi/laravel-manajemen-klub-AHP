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
        <a class="active" href="#home">PEMAIN</a>
    </div>
    <div id="about_faq" class="about_lav" >
        <div class="about_1">
            <form method="POST" action="{{route('editPemain', $data[0]['id'])}}" enctype="multipart/form-data"> 
            @csrf
            <div class="row">
                @foreach($data as $pemain)
                <div class="col-sm-4" style="height: 100%;">
                    <img src="{{asset('assets/img/pemain/'.$pemain['img'])}}" alt="" style="width:100%;  float:left; height: 100%;  float:left; border: 5px solid black;object-fit: cover;"><br>
                    <div class="form-group-row">
                        <div class="col-md-12">
                            <center>
                                <h4>EDIT IMAGE</h4>
                            </center>
                            <input id="image" type="file" class="form-control" name="image" value="{{old('image')}}">
                        </div>
                    </div>
                </div>

                <div class="col-sm-8" >
                    <b>Nama Pemain : </b>
                    <p>
                        <input type="text" name="namaPemain" class="form-control @error('namaPemain') is-invalid @enderror" value="{{$pemain['nama_pemain']}}">
                    </p>
                    <b>Tempat, Tgl Lahir : </b>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input id="tempat" type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" value="{{ $pemain['tempat']}}" required autocomplete="tempat">
                        </div>
                        <div class="col-sm-8">
                            <input id="tglLahir" type="date" class="form-control @error('tglLahir') is-invalid @enderror" name="tglLahir" value="{{ $pemain['tgl_lahir']}}" required autocomplete="tglLahir">
                        </div>
                    </div>
                    <br>
                    <b>Alamat : </b>
                    <p>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{$pemain['alamat']}}">    
                    </p>
                    <b>No Telephone : </b>
                    <p>
                        <input type="text" name="notelp" class="form-control @error('notelp') is-invalid @enderror" value="{{$pemain['notelp']}}">
                    </p>
                    <b>Tinggi : </b>
                    <p>
                        <input type="text" name="tinggi" class="form-control @error('tinggi') is-invalid @enderror" value="{{$pemain['tinggi']}}">
                    </p>
                    <b>Berat : </b>
                    <p>
                        <input type="text" name="berat" class="form-control @error('berat') is-invalid @enderror" value="{{$pemain['berat']}}">
                    </p>
                    <b>Status : </b>
                    <p>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </p>
                    <b>Klub : </b>
                    <p>
                        <select name="klub" id="klub" class="form-control @error('klub') is-invalid @enderror">
                            <option value="{{$pemain['nama_klub']}}">{{$pemain['nama_klub']}}</option>
                            <option value=""></option>
                            @foreach ($dataKlub as $data)
                            <option value="{{$data['nama_klub']}}">{{$data['nama_klub']}}</option>
                            @endforeach
                        </select>
                    </p>
                    <b>Posisi : </b>
                    <p>
                        <select name="posisi" id="posisi" class="form-control @error('posisi') is-invalid @enderror">
                            <option value="pemain">Pemain</option>
                            <option value="kiper">Kiper</option>
                        </select>
                    </p>
                    
                        
                                                
                </div>
                @endforeach
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('SIMPAN') }}
                    </button>
                </div>
                
            </div>
            </form>
        </div>
    </div>


</section>
@endsection