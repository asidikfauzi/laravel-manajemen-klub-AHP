<?php

namespace App\Http\Controllers;

use DB;
use App\Models\HasilSubKriteria;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function goal()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_goal"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('hasil_sub_kriteria.sub_kriteria_id', 23)
                                    ->where('pemain.status', 'aktif')
                                    ->groupBy('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub")
                                    ->orderBy('jumlah_goal', 'DESC')
                                    ->get();
        return view('dashboard.rekomendasi.goal', compact('data'));
    }
    public function assist()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_assist"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('hasil_sub_kriteria.sub_kriteria_id', 24)
                                    ->where('pemain.status', 'aktif')
                                    ->groupBy('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub")
                                    ->orderBy('jumlah_assist', 'DESC')
                                    ->get();
        return view('dashboard.rekomendasi.assist', compact('data'));
    }
    public function kuning()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_kuning"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('pemain.posisi', 'pemain')
                                    ->where('pemain.status', 'aktif')
                                    ->where(function($q) {
                                        $q->orWhere('hasil_sub_kriteria.sub_kriteria_id', 1)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 2)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 3)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 4);
                                    })
                                    ->groupBy('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub")
                                    ->orderBy('jumlah_kuning', 'DESC')
                                    ->get();
        return view('dashboard.rekomendasi.kuning', compact('data'));
    }
    public function merah()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_merah"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('pemain.posisi', 'pemain')
                                    ->where('pemain.status', 'aktif')
                                    ->where(function($q) {
                                        $q->orWhere('hasil_sub_kriteria.sub_kriteria_id', 5)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 6)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 7)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 8);
                                    })
                                    ->groupBy('pemain.nama_pemain','hasil_sub_kriteria.musim', "pemain.nama_klub")
                                    ->orderBy('jumlah_merah', 'DESC')
                                    ->get();
        return view('dashboard.rekomendasi.merah', compact('data'));
    }
    public function attitude()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_attitude"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('pemain.posisi', 'pemain')
                                    ->where('pemain.status', 'aktif')
                                    ->where(function($q) {
                                        $q->orWhere('hasil_sub_kriteria.sub_kriteria_id', 17)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 18)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 19);
                                    })
                                    ->groupBy('pemain.nama_pemain','hasil_sub_kriteria.musim', "pemain.nama_klub")
                                    ->orderBy('jumlah_attitude', 'DESC')
                                    ->get();
        return view('dashboard.rekomendasi.attitude', compact('data'));
    }
    public function kebobolan()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_kebobolan"))
                ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                ->where('hasil_sub_kriteria.sub_kriteria_id', 25)
                ->where('pemain.status', 'aktif')
                ->groupBy('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub")
                ->orderBy('jumlah_kebobolan', 'DESC')
                ->get();
        return view('dashboard.rekomendasi.kebobolan', compact('data'));
    }
    public function penyelamatan()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_penyelamatan"))
                ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                ->where('hasil_sub_kriteria.sub_kriteria_id', 26)
                ->where('pemain.status', 'aktif')
                ->groupBy('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub")
                ->orderBy('jumlah_penyelamatan', 'DESC')
                ->get();
        return view('dashboard.rekomendasi.penyelamatan', compact('data'));
    }
    public function kuningKiper()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_kuning_kiper"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('pemain.posisi', 'kiper')
                                    ->where('pemain.status', 'aktif')
                                    ->where(function($q) {
                                        $q->orWhere('hasil_sub_kriteria.sub_kriteria_id', 9)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 10)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 11)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 12);
                                    })
                                    ->groupBy('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub")
                                    ->orderBy('jumlah_kuning_kiper', 'DESC')
                                    ->get();
        return view('dashboard.rekomendasi.kuning-kiper', compact('data'));
    }
    public function merahKiper()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_merah_kiper"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('pemain.posisi', 'kiper')
                                    ->where('pemain.status', 'aktif')
                                    ->where(function($q) {
                                        $q->orWhere('hasil_sub_kriteria.sub_kriteria_id', 13)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 14)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 15)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 16);
                                    })
                                    ->groupBy('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub")
                                    ->orderBy('jumlah_merah_kiper', 'DESC')
                                    ->get();
        return view('dashboard.rekomendasi.merah-kiper', compact('data'));
    }
    public function attitudeKiper()
    {
        $data = HasilSubKriteria::select('pemain.nama_pemain', 'hasil_sub_kriteria.musim', "pemain.nama_klub", DB::raw("SUM(hasil_sub_kriteria.jumlah) as jumlah_attitude_kiper"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('pemain.posisi', 'kiper')
                                    ->where('pemain.status', 'aktif')
                                    ->where(function($q) {
                                        $q->orWhere('hasil_sub_kriteria.sub_kriteria_id', 20)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 21)
                                        ->orWhere('hasil_sub_kriteria.sub_kriteria_id', 22);
                                    })
                                    ->groupBy('pemain.nama_pemain','hasil_sub_kriteria.musim', "pemain.nama_klub")
                                    ->orderBy('jumlah_attitude_kiper', 'DESC')
                                    ->get();
        return view('dashboard.rekomendasi.attitude-kiper', compact('data'));
    }
    
}
