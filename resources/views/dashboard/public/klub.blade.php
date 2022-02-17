@extends('layouts.public')
@section('content')

<style>


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
}

.topnav a.active {
  background-color: #032A63;
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
	<div class="content">
		<div class="topnav">
		  	<a class="active" href="#home">Home</a>
		  	
		  	<div class="search-container">
		    	<form action="/action_page.php">

		      		<input type="text" placeholder="Search.." name="search">
		      		<button type="submit"><i class="fa fa-search"></i></button>
		    	</form>
		  	</div>
		</div><br>
	  
    <form method="POST" action="{{ url('klub') }}"> 
      <h1 class="text-center">DAFTAR KLUB FUTSAL KABUPATEN SUMENEP</h1>
      <p class="text-center">Klub Futsal Dalam Naungan AFKAB Sumenep</p><br>
      
        <div class="row">
            <div class="col-md-12">
                <div id="grid" class="row">
                  @foreach ($data as $klub)
                  <div class="mix col-sm-4 margin30">
                    <div class="item-img-wrap">
                        <img src="{{asset('assets/img/klub/'.$klub['img'])}}" class="rounded mx-auto d-block" alt="image klub" style="width: 300px; height: 300px;">
                        <div class="item-img-overlay">
                            <a  style="text-decoration: none" href="{{route('detailklub',$klub['id'])}}" class="show-image">
                                <center><h5><span>{{$klub['nama_klub']}}</span></h5></center>
                            </a>
                        </div>
                    </div> 
                  </div>
                  @endforeach                                                             
                </div>
            </div>
        </div>
      </div>
    </form>
	</div>
</section>
@endsection

