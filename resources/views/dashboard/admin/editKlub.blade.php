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
        <a class="active" href="#home">EDIT KLUB</a> 
        <div class="search-container">
          <a class="active" href="{{route('strukturKlub', $data[0]['id'])}}">Tambah Struktur Klub</a>
        </div>
    </div>
      <div id="about_faq" class="about_lav" >
        <div class="about_1">
          <form method="POST"  action="{{route('editKlub', $data[0]['id'])}}" enctype="multipart/form-data"> 
          @csrf  
          <div class="row" >
            @foreach($data as $klub)
              <div class="col-sm-4" style="height: 100%;">
                  <img src="{{asset('assets/img/klub/'.$klub['img'])}}" alt="" style="width:100%;  float:left; height: 100%;  float:left; border: 5px solid black;object-fit: cover;"><br>
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
                  <b>Nama Klub : </b>
                  <p>
                      <input type="text" name="namaKlub" class="form-control @error('namaKlub') is-invalid @enderror" value="{{$klub['nama_klub']}}">
                  </p>
                  <b>Tanggal Berdiri :</b>
                  <p>
                      <input id="tglBerdiri" type="date" class="form-control @error('tglBerdiri') is-invalid @enderror" name="tglBerdiri" value="{{$klub['tgl_berdiri']}}" required autocomplete="tglBerdiri">
                  </p>
                  <b>Alamat : </b>
                  <p>
                      <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{$klub['alamat']}}" required autocomplete="alamat">
                  </p>
                  <b>No. Telephone : </b>
                  <p>
                      <input id="notelp" type="text" class="form-control @error('notelp') is-invalid @enderror" name="notelp" value="{{$klub['notelp']}}" required autocomplete="notelp">
                  </p>
                  <b>Jadwal Latihan : </b>
                  <p>
                      <textarea  rows="5" cols="50" id="jadwalLatihan" class="form-control @error('jadwalLatihan') is-invalid @enderror" name="jadwalLatihan" required autocomplete="jadwalLatihan">{{ urldecode($klub['jadwal_latihan'])}}</textarea>
                  </p>
                  <b>Sejarah Klub : </b>
                  <p>
                      <textarea  rows="5" cols="50" id="sejarahKlub" class="form-control @error('sejarahKlub') is-invalid @enderror" name="sejarahKlub"  required autocomplete="sejarahKlub">{{urldecode($klub['sejarah_klub'])}}</textarea>
                  </p> 
                  <br>
              </div>
              @endforeach
              
              <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{ __('SIMPAN') }}
                  </button>
              </div>
            </form>
          </div>
        </div>
    </div>
</section>
@endsection