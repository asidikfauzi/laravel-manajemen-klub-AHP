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
        <a class="active" href="#home">KLUB</a> 
        
        <div class="search-container">
            <a class="active" href="{{ url('pemain', $data[0]['nama_klub']) }}">PEMAIN</a> 
            <a class="active" href="#home">OFFICIAL</a>
            <a class="active" href="{{route('showStrukturKlub', $data[0]['id'])}}">STRUKTUR KLUB</a>
        </div>

    </div>
    
    
      <div id="about_faq" class="about_lav" >
            <div class="about_1">
              
                    <div class="row" >
                      @foreach($data as $klub)
                        <div class="col-sm-4" style="height: 100%;">
                            <img src="{{asset('assets/img/klub/'.$klub['img'])}}" alt="" style="width:100%;  float:left; height: 100%;  float:left; border: 5px solid black;object-fit: cover;"><br>
                            
                        </div>

                        <div class="col-sm-8" >
                            <h2>{{$klub['nama_klub']}}</h2>
                            <b>Tanggal Berdiri : </b>
                            <p>{{$klub['tgl_berdiri']}}</p>
                            <b>Alamat : </b>
                            <p>{{$klub['alamat']}}</p>
                            <b>No. Telephone : </b>
                            <p>{{$klub['notelp']}}</p>
                            <b>Jadwal Latihan </b>
                            @foreach(explode("%0D%0A", $klub['jadwal_latihan']) as $j)
                            <p style="padding:0; margin: 0;">{{urldecode($j)}}</p>   
                            @endforeach
                            <br><b>Sejarah Klub : </b>
                            @foreach(explode("%0D%0A", $klub['sejarah_klub']) as $j)
                            <p style="padding:0; margin: 0;">{{urldecode($j)}}<br></p>   
                            @endforeach
                        </div>
                        @endforeach
                        
                    </div>
          
        
      </div>
    </div>


</section>
@endsection