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
        <a class="active" href="#home">EDIT BERITA DAN AKTIVITAS</a> 
    </div>
      <div id="about_faq" class="about_lav" >
        <div class="about_1">
          <form method="POST" action="{{route('editBerita', $data[0]['id'])}}" enctype="multipart/form-data"> 
          @csrf  
          <div class="row" >
                <div class="col-sm-4" style="height: 100%;">
                    <img src="{{asset('assets/img/berita/'.$data[0]['img'])}}" alt="" style="width:100%;  float:left; height: 100%;  float:left; border: 5px solid black;object-fit: cover;"><br>
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
                    <b>Judul Berita : </b>
                    <p>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{$data[0]['judul_berita']}}">
                    </p>
                    <b>Isi Berita : </b>
                    <p>
                        <textarea  rows="10" cols="50" id="isi_berita" class="form-control @error('isi_berita') is-invalid @enderror" name="isi_berita"  required autocomplete="isi_berita">{{urldecode($data[0]['isi_berita'])}}</textarea>
                    </p>
                </div>
                
                <div class="col-md-8 offset-md-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalSave">
                        Simpan
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalSave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Peringatan !</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin dengan perubahan ini ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save Changes</button>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>

        
    </section>
    @endsection