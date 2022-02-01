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
	<div class="col-sm-12">
    <div class="card aos-init aos-animate" data-aos="fade-up">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="font-weight-600 mb-4">
                        <center>
                            PERATURAN PERTANDINGAN FUTSAL
                        </center>
                    </h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <pre>    <b>A. BIDANG INTERNAL</b>
        1.  Pembenahan Administrasi Organisasi;
        2.  Menyusun Statuta Asosiasi Futsal Kabupaten Sumenep;
        3.  Penyediaan Sekretariat Organisasi yang Tetap dan Representatif;
        4.  Pembuatan Atribut Organisasi;
        5.  Penyempurnaan Manajemen Organisasi;
        6.  Penyelenggara Liga Futsal Sumenep;
        7.  Penyelenggara Turnamen Futsal Pelajar, Mahasiswa, dan Wanita;
        8.  Penyelenggara Kursus Pelatih Futsal dan Coaching Clinic;
        9.  Membuat Rencana Bisnis Pengembangan Futsal di Kabupaten Sumenep;
        10. Melaksanakan Pembinaan Klub Futsal di Kabupaten Sumenep;
                        </pre>
                    </div>

                    <div class="row">
                        <pre>    <b>B. BIDANG EXTERNAL</b>
        1.  Melaksanakan Koordinasi dengan Asprop PSSI Jawa Timur, AFD Jawa Timur KONI 
            Kabupaten Sumenep dan AFKAB PSSI Kabupaten Sumenep terkait hasil - hasil 
            penyelenggara kongres asosiasi futsal kabupaten;
        2.  Menyampaikan Laporan Pelaksanaan Kongres Asosisasi Futsal Kabupaten Sumenep 
            Kepada AFD Jawa Timur;
        3.  Menyampaikan Susunan Pengurus Asosiasi Futsal Kabupaten Hasil Kongres Asosiasi
            Futsal Kabupaten Sumenep Kepada AFD Jawa Timur untuk mendapatkan pengesahan
            dan Surat Keputusan (SK);
        4.  Melaksanakan Koordinasi Dengan Pihak Pemerintahan Daerah Kabupaten Sumenep 
            Terkait hasil - hasil kongres Asosiasi Futsal Kabupaten Sumenep sekaligus
            Sosialisasi Rencana Kerja Pengurus Asosiasi Futsal Kabupaten Sumenep Selama
            Periode 2021-2025;
        
                        </pre>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="trending">
                        <h2 class="mb-4 font-weight-600" style="color: #032A63">
                            Official Sponsor
                        </h2>
                        <div class="mb-4">
                            <div class="rotate-img">
                                <img src="{{asset('assets/img/sponsor/spectra.png')}}" alt="banner" class="img-fluid">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="rotate-img">
                                <img src="{{asset('assets/img/sponsor/bca.png')}}" alt="banner" class="img-fluid">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="rotate-img">
                                <img src="{{asset('assets/img/sponsor/unity.png')}}" alt="banner" class="img-fluid">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="rotate-img">
                                <img src="{{asset('assets/img/sponsor/bri.png')}}" alt="banner" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


@endsection