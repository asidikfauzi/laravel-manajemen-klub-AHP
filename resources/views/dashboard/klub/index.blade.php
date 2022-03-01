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
        <a class="active" href="#home">Welcome {{Auth::user()->username}}</a> 
        
        <div class="search-container">
            <a class="active" href="{{ url('pemain', $data[0]['nama_klub']) }}">PEMAIN</a> 
            <a class="active" href="{{route('klub.showStrukturKlub', $data[0]['id'])}}">STRUKTUR KLUB</a>
        </div>
    </div>
      <div id="about_faq" class="about_lav" >
            <div class="about_1">
                <form method="POST" action="{{route('klub.dashboard')}}" enctype="multipart/form-data"> 
                    @csrf
                    <div class="row" >
                      @foreach($data as $klub)
                        <div class="col-sm-4" style="height: 100%;">
                            <a href="{{asset('assets/img/klub/'.$klub['img'])}}" target="_blank">
                                <img src="{{asset('assets/img/klub/'.$klub['img'])}}" alt="" style="width:100%;  float:left; height: 100%;  float:left; border: 5px solid black;object-fit: cover;"><br>
                            </a>
                            <center>
                                <h4>EDIT IMAGE</h4>
                            </center>
                            <input id="image" type="file" class="form-control" name="image" value="{{old('image')}}" >
                            
                        </div>
                        
                        <div class="col-sm-8" >
                            <h2>{{$klub['nama_klub']}}</h2>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right"><b>Tanggal Berdiri </b></label>
                                <div class="col-md-8 mb-1"> 
                                    <input id="tglBerdiri" type="date" class="form-control @error('tglBerdiri') is-invalid @enderror" name="tglBerdiri" value="{{$klub['tgl_berdiri']}}" required autocomplete="tglBerdiri">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-3 col-form-label text-md-right"><b>Alamat</b></label>
                                <div class="col-md-8 mb-1"> 
                                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{$klub['alamat']}}" required autocomplete="alamat">
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label text-md-right"><b>No. Telephone</b></label>
                                <div class="col-md-8 mb-1"> 
                                    <input id="notelp" type="text" class="form-control @error('notelp') is-invalid @enderror" name="notelp" value="{{$klub['notelp']}}" required autocomplete="notelp">
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label text-md-right"><b>Jadwal Latihan</b></label>
                              <div class="col-md-8 mb-1"> 
                                <textarea  rows="5" cols="50" id="jadwalLatihan" class="form-control @error('jadwalLatihan') is-invalid @enderror" name="jadwalLatihan" required autocomplete="jadwalLatihan">{{ urldecode($klub['jadwal_latihan'])}}</textarea>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label text-md-right"><b>Sejarah Klub</b></label>
                              <div class="col-md-8 mb-1"> 
                                <textarea  rows="10" cols="50" id="sejarahKlub" class="form-control @error('sejarahKlub') is-invalid @enderror" name="sejarahKlub" required autocomplete="sejarahKlub">{{ urldecode($klub['sejarah_klub'])}}</textarea>
                              </div>
                              
                            </div>
                            
                        </div>
                        @endforeach
                        
                        <div class="col-md-8 offset-md-6">
                            
                            <button type="submit" class="btn btn-primary mt-3">
                                {{ __('SIMPAN') }}
                            </button>
                        </div>
                        
                    </div>
                </form>
          
        
      </div>
    </div>


</section>
@endsection