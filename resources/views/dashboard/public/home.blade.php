@extends('layouts.public')
@section('content')

<br><br><br>

<div class="row aos-init aos-animate" data-aos="fade-up">
    <div class="col-xl-8 stretch-card-center grid-margin">
        <div class="position-relative">
            <div id="carouselExampleSlidesOnly" class="carousel slide pointer-event" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="text-align:center;">
                        <img src="{{asset('assets/img/futsalnya.jpg')}}" class="img-fluid" style="height: 450px; width: 100%; margin:auto; overflow: hidden;" alt="Responsive image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 stretch-card grid-margin">
        <div class="card bg-primary text-white">
            <div class="card-body" style="height: 450px">

                <h2 style="text-align: center;">VISI & MISI</h2>
                <div class="text-center">
                    <div class="pr-5">
                        <b>Bersinergi membawa Futsal Indonesia menuju Empat Besar Asia dan berlaga di Pentas Dunia. Menjadikan Futsal sebagai olahraga industri dan membanggakan di kancah internasional.</b>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row aos-init aos-animate" data-aos="fade-up">
    <div class="col-lg-12 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <center>
                    <a href="{{route('pemain.rekomendasi.terbaik')}}" style="text-decoration: none"><b>Hasil Poin Pemain / Rekomendasi Pemain Terbaik</b></a>
                </center>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row aos-init aos-animate" data-aos="fade-up">
    <div class="col-lg-3 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <center>
                    <h2>Klub Futsal</h2>
                </center>
                @foreach($dataKlub as $data)
                    <center>
                        <img src="{{$data['img']}}" style="width: 100px; height:100px;" class="rounded mx-auto d-block">
                        <li style="list-style: none"><a style="text-decoration: none" href="{{route('detailklub',$data['id'])}}">{{$data['nama_klub']}}</a></li>
                    </center>
                @endforeach
            </div>
            <br>
            <center>
                <a href="klub" style="text-decoration: none"><b>Lihat semua club</b></a>
            </center>
            <br>
        </div>
    </div><div class="col-lg-9 stretch-card grid-margin">
    <div class="card" style="overflow: auto; height: auto">
        <div class="card-body">
            @foreach($dataBerita as $data)
            <h5><i class="glyphicon glyphicon-comment"> {{$data['judul_berita']}}</i></h5>
            <div class="row" >
                <div class="col-sm-8">
                    @foreach(explode("%0D%0A", $data['isi_berita']) as $j)
                        <p>{{urldecode($j)}}</p> 
                    @endforeach
                </div>
                <div class="col-sm-4">
                    <img src="{{asset('assets/img/berita/'.$data['img'])}}" alt="" style="width:100%;float:left;"><br>
                </div>
            </div>
            <hr>
            @endforeach 

        </div>
    </div>
</div>

</div>

@endsection