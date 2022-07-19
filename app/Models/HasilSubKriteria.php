<?php

namespace App\Models;

use App\Models\HasilSubKriteria as ModelsHasilSubKriteria;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSubKriteria extends Model
{
    use HasFactory;
    protected $table = "hasil_sub_kriteria";
    protected $guarded =[];
    protected $primaryKey = null;
    public $incrementing = false;


    // AHP
    // 
    // Jumlah Goal PV = 0.5
    static function jumlahGoal()   
    {
        $bobot = Kriteria::where('id', 1)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];   
        $data = HasilSubKriteria::select('hasil_sub_kriteria.pemain_id', 'hasil_sub_kriteria.musim', DB::raw("SUM(hasil_sub_kriteria.jumlah * $jumlah) as jumlah_goal"))
                                    ->join('pemain', 'hasil_sub_kriteria.pemain_id', '=', 'pemain.id')
                                    ->where('hasil_sub_kriteria.sub_kriteria_id', 23)
                                    ->where('pemain.status', 'aktif')
                                    ->groupBy('hasil_sub_kriteria.pemain_id', 'hasil_sub_kriteria.musim')->get();
        return $data;
    }
    //Jumlah Assist PV = 0.25
    static function jumlahAssist()
    {
        $bobot = Kriteria::where('id', 2)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];  
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_assist"))
                                    ->where('sub_kriteria_id', 24)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }


    //KARTU KUNING -------------------------------------------------------------------------
    //Jumlah Pelanggaran Kartu Kuning
    static function jumlahPelanggaranKuning()
    {
        $bobot = SubKriteria::where('id', 1)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];  
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_pelanggaran_kuning"))
                                    ->where('sub_kriteria_id', 1)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Provokasi Kartu Kuning
    static function jumlahProvokasiKuning()
    {
        $bobot = SubKriteria::where('id', 2)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_provokasi_kuning"))
                                    ->where('sub_kriteria_id', 2)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Memukul Kartu Kuning
    static function jumlahMemukulKuning()
    {
        $bobot = SubKriteria::where('id', 3)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_memukul_kuning"))
                                    ->where('sub_kriteria_id', 3)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Selebrasi Kartu Kuning
    static function jumlahSelebrasiKuning()
    {
        $bobot = SubKriteria::where('id', 4)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_selebrasi_kuning"))
                                    ->where('sub_kriteria_id', 4)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //KARTU MERAH ----------------------------------------------------------------
    //Jumlah Pelanggaran Kartu Merah
    static function jumlahPelanggaranMerah()
    {
        $bobot = SubKriteria::where('id', 5)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_pelanggaran_merah"))
                                    ->where('sub_kriteria_id', 5)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Provokasi Kartu Merah
    static function jumlahProvokasiMerah()
    {
        $bobot = SubKriteria::where('id', 6)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_provokasi_merah"))
                                    ->where('sub_kriteria_id', 6)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Memukul Kartu Merah
    static function jumlahMemukulMerah()
    {
        $bobot = SubKriteria::where('id', 7)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_memukul_merah"))
                                    ->where('sub_kriteria_id', 7)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Selebrasi Kartu Merah
    static function jumlahSelebrasiMerah()
    {
        $bobot = SubKriteria::where('id', 8)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_selebrasi_merah"))
                                    ->where('sub_kriteria_id', 8)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }


    //ATTITUDE PEMAIN-------------------------------------------------------------
    //WAKTU
    static function jumlahWaktuPemain()
    {
        $bobot = SubKriteria::where('id', 17)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_waktu_pemain"))
                                    ->where('sub_kriteria_id', 17)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    static function jumlahRespectPemain()
    {
        $bobot = SubKriteria::where('id', 18)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_respect_pemain"))
                                    ->where('sub_kriteria_id', 18)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    static function jumlahMentalPemain()
    {
        $bobot = SubKriteria::where('id', 19)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_mental_pemain"))
                                    ->where('sub_kriteria_id', 19)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    

    //KIPER ------------------------------------------------------------------------------------------------------------
    static function jumlahKebobolan()   
    {
        $bobot = Kriteria::where('id', 6)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_kebobolan"))
                                    ->where('sub_kriteria_id', 25)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    static function jumlahPenyelamatan()
    {
        $bobot = Kriteria::where('id', 7)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_penyelamatan"))
                                    ->where('sub_kriteria_id', 26)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }


    //KARTU KUNING -------------------------------------------------------------------------
    //Jumlah Pelanggaran Kartu Kuning
    static function jumlahPelanggaranKuningKiper()
    {
        $bobot = SubKriteria::where('id', 9)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_pelanggaran_kuning"))
        ->where('sub_kriteria_id', 9)
        ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Provokasi Kartu Kuning
    static function jumlahProvokasiKuningKiper()
    {
        $bobot = SubKriteria::where('id', 10)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_provokasi_kuning"))
                                    ->where('sub_kriteria_id', 10)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Memukul Kartu Kuning
    static function jumlahMemukulKuningKiper()
    {
        $bobot = SubKriteria::where('id', 11)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_memukul_kuning"))
                                    ->where('sub_kriteria_id',11)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Selebrasi Kartu Kuning
    static function jumlahSelebrasiKuningKiper()
    {
        $bobot = SubKriteria::where('id', 12)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_selebrasi_kuning"))
                                    ->where('sub_kriteria_id', 12)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //KARTU MERAH ----------------------------------------------------------------
    //Jumlah Pelanggaran Kartu Merah
    static function jumlahPelanggaranMerahKiper()
    {
        $bobot = SubKriteria::where('id', 13)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_pelanggaran_merah"))
                                    ->where('sub_kriteria_id', 13)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Provokasi Kartu Merah
    static function jumlahProvokasiMerahKiper()
    {
        $bobot = SubKriteria::where('id', 14)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_provokasi_merah"))
                                    ->where('sub_kriteria_id', 14)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Memukul Kartu Merah
    static function jumlahMemukulMerahKiper()
    {
        $bobot = SubKriteria::where('id', 15)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_memukul_merah"))
                                    ->where('sub_kriteria_id', 15)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Selebrasi Kartu Merah
    static function jumlahSelebrasiMerahKiper()
    {
        $bobot = SubKriteria::where('id', 16)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_selebrasi_merah"))
                                    ->where('sub_kriteria_id', 16)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }


    //ATTITUDE PEMAIN-------------------------------------------------------------
    //WAKTU
    static function jumlahWaktuPemainKiper()
    {
        $bobot = SubKriteria::where('id', 20)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_waktu_pemain"))
                                    ->where('sub_kriteria_id', 20)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    static function jumlahRespectPemainKiper()
    {
        $bobot = SubKriteria::where('id', 21)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_respect_pemain"))
                                    ->where('sub_kriteria_id', 21)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    static function jumlahMentalPemainKiper()
    {
        $bobot = SubKriteria::where('id', 22)->get()->toArray();
        $jumlah = $bobot[0]['bobot'];
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw("SUM(jumlah*$jumlah) as jumlah_mental_pemain"))
                                    ->where('sub_kriteria_id', 22)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    

    
}
