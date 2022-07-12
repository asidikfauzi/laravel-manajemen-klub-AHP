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
                            <h1 class="text-center">WELCOME {{Auth::user()->username}}</h1>
                            <p class="text-center">ASOSIASI FUTSAL KABUPATEN SUMENEP</p>
                            <hr>
                            <button type="submit"  onclick="window.location.href='{{route('showAdmin')}}'" class="btn btn-primary col-sm-12">
                                {{ __('DATA ADMIN') }}
                            </button>
                            <hr>    
                            <button type="submit" onclick="window.location.href='{{route('showKlub')}}'" class="btn btn-primary col-sm-12">
                                {{ __('DATA KLUB') }}
                            </button>
                            <hr>
                            <button type="submit"  onclick="window.location.href='{{route('showPemain')}}'" class="btn btn-primary col-sm-12">
                                {{ __('DATA PEMAIN') }}
                            </button>
                            <hr>
                            <button type="submit"  onclick="window.location.href='{{route('showKontrak')}}'" class="btn btn-primary col-sm-12">
                                {{ __('DATA KONTRAK') }}
                            </button>
                            <hr>
                            <button type="submit" onclick="window.location.href='{{route('beritaDanAktivitas')}}'" class="btn btn-primary col-sm-12">
                                {{ __('BERITA DAN AKTIVITAS') }}
                            </button>
                            <hr>
                            <button type="submit" onclick="window.location.href='{{route('poinpemain')}}'" class="btn btn-primary col-sm-12">
                                {{ __('POINT PEMAIN / KIPER') }}
                            </button>
                            <hr>
                            <button type="submit" onclick="window.location.href='{{route('kriteriasubkriteria')}}'" class="btn btn-primary col-sm-12">
                                {{ __('NILAI KRITERIA DAN SUB KRITERIA') }}
                            </button>
                            <hr>
                            
                        </div>
                    </div>
            </div>
        </div>
	</div>
</section>


@endsection