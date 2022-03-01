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
                        <pre>    <b>Luas lapangan</b>
        1.  Ukuran: 25m x 15m                      
        2.  Garis batas: garis selebar 8 cm, yakni garis sentuh di sisi, garis gawang di ujung-ujung, dan 
            garis melintang tengah lapangan; 3 m lingkaran tengah; tak ada tembok penghalang atau papan. 
            Memakai pengaman Jaring sebagai pembatas agar bola tidak terlempar jauh.
        3.  Daerah penalti: busur berukuran 6 m dari masing-masing tiang gawang
        4.  Titik penalti: 6 m dari titik tengah garis gawang
        5.  Titik penalti kedua: 10 m dari titik tengah garis gawang
        6.  Zona pergantian: daerah 5 m (5 m dari garis tengah lapangan) pada sisi tribun dari pelemparan
        7.  Gawang: tinggi 2 m x lebar 3 m
        8.  Permukaan daerah pelemparan: halus, rata, dan tak abrasif
                        </pre>
                        <pre>   <b>Bola</b>            
        1.  Ukuran: 4
        2.  Keliling: 62–64 cm
        3.  Berat: 0,4 - 0,44 kg
        4.  Lambungan: 55–65 cm pada pantulan pertama
        5.  Bahan: kulit atau bahan yang cocok lainnya (yaitu bahan tak berbahaya)
                        </pre>
                        <pre>   <b>Jumlah pemain (per team)</b>      
        1.  Jumlah pemain maksimal untuk memulai pertandingan: 5, salah satunya penjaga gawang
        2.  Jumlah pemain minimal untuk mengakhiri pertandingan: 2 (tidak termasuk cedera)
        3.  Jumlah pemain cadangan maksimal: 7
        4.  Jumlah wasit: 2
        5.  Jumlah hakim garis: 0
        6.  Batas jumlah pergantian pemain: tak terbatas
        7.  Metode pergantian: "pergantian melayang" (semua pemain kecuali penjaga gawang boleh memasuki 
            dan meninggalkan lapangan kapan saja; pergantian penjaga gawang hanya dapat dilakukan jika bola 
            tak sedang dimainkan dan dengan persetujuan wasit)
        8.  Dan wasit pun tidak boleh menginjak arena lapangan, hanya boleh di luar garis lapangan saja, 
            terkecuali jika ada pelanggaran-pelanggaran yang harus memasuki lapangan
                        </pre>
                        <pre>   <b>Lama permainan</b>
        1.  Lama normal: 2x20 menit
        2.  Lama istirahat: 10 menit
        3.  Lama perpanjangan waktu: 2x5 menit (bila hasil masih imbang setelah 2x20 menit waktu normal)
        4.  Ada adu penalti (maksimal 5 gol) jika jumlah gol kedua tim seri saat perpanjangan waktu selesai
        5.  Time-out: 1 per tim per babak; tak ada dalam waktu tambahan
        6.  Waktu pergantian babak: maksimal 10 menit
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