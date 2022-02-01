@extends('layouts.public')
@section('content')

<style>

.about_1{
    padding: 20px;
}
.about_lav{
    background: #E8E8E8;
}
</style>

<section class="page-section">
	<div class="content">
	  	<div id="about_faq" class="about_lav" >
            <div class="about_1">
                    <div class="row" >
                        <div class="col-sm-4" style="height: 300px">
                            <center>
                                <img src="{{asset('assets/img/afkabpssi.png')}}" alt="" style="background-position: center; height: 300px;  object-fit: cover;">
                            </center>
                        </div>
                        <div class="col-sm-8" >
                            <h1 class="text-center">PROFILE AFKAB SUMENEP</h1>
                            <p class="text-center">ASOSIASI FUTSAL KABUPATEN SUMENEP</p>
                            <p>Federasi Futsal Indonesia Federasi Futsal Indonesia adalah sebuah organisasi
                                 olahraga yang menaungi aktivitas futsal di Indonesia. Organisasi ini berada 
                                 dalam naungan Persatuan Sepak Bola Seluruh Indonesia. Organisasi ini merupakan 
                                 pembaruan dari Badan Futsal Nasional yang dibubarkan PSSI pada tahun 2014, 
                                 serta berganti nama dari Asosiasi Futsal Indonesia yang dibentuk pada tahun 
                                 22 Juni 2014. Organisasi ini mengatur kegiatan tim nasional futsal Indonesia 
                                 dan menjalankan kompetisi Liga Futsal Profesional Indonesia.</p>
                        </div>
                    </div>
            </div>
        </div>
	</div>
</section>


@endsection