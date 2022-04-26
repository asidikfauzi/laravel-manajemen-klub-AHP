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
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.502) as jumlah_goal'))
                                    ->where('sub_kriteria_id', 23)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Assist PV = 0.25
    static function jumlahAssist()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.254) as jumlah_assist'))
                                    ->where('sub_kriteria_id', 24)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }


    //KARTU KUNING -------------------------------------------------------------------------
    //Jumlah Pelanggaran Kartu Kuning
    static function jumlahPelanggaranKuning()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.059) as jumlah_pelanggaran_kuning'))
                                    ->where('sub_kriteria_id', 1)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Provokasi Kartu Kuning
    static function jumlahProvokasiKuning()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.274) as jumlah_provokasi_kuning'))
                                    ->where('sub_kriteria_id', 2)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Memukul Kartu Kuning
    static function jumlahMemukulKuning()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.530) as jumlah_memukul_kuning'))
                                    ->where('sub_kriteria_id', 3)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Selebrasi Kartu Kuning
    static function jumlahSelebrasiKuning()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.138) as jumlah_selebrasi_kuning'))
                                    ->where('sub_kriteria_id', 4)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //KARTU MERAH ----------------------------------------------------------------
    //Jumlah Pelanggaran Kartu Merah
    static function jumlahPelanggaranMerah()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.059) as jumlah_pelanggaran_merah'))
                                    ->where('sub_kriteria_id', 5)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Provokasi Kartu Merah
    static function jumlahProvokasiMerah()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.274) as jumlah_provokasi_merah'))
                                    ->where('sub_kriteria_id', 6)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Memukul Kartu Merah
    static function jumlahMemukulMerah()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.530) as jumlah_memukul_merah'))
                                    ->where('sub_kriteria_id', 7)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Selebrasi Kartu Merah
    static function jumlahSelebrasiMerah()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.138) as jumlah_selebrasi_merah'))
                                    ->where('sub_kriteria_id', 8)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }


    //ATTITUDE PEMAIN-------------------------------------------------------------
    //WAKTU
    static function jumlahWaktuPemain()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.703) as jumlah_waktu_pemain'))
                                    ->where('sub_kriteria_id', 17)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    static function jumlahRespectPemain()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.115) as jumlah_respect_pemain'))
                                    ->where('sub_kriteria_id', 18)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    static function jumlahMentalPemain()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.182) as jumlah_mental_pemain'))
                                    ->where('sub_kriteria_id', 19)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    



    //KIPER ------------------------------------------------------------------------------------------------------------
    static function jumlahKebobolan()   
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.502) as jumlah_kebobolan'))
                                    ->where('sub_kriteria_id', 25)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    static function jumlahPenyelamatan()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.254) as jumlah_penyelamatan'))
                                    ->where('sub_kriteria_id', 26)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }


    //KARTU KUNING -------------------------------------------------------------------------
    //Jumlah Pelanggaran Kartu Kuning
    static function jumlahPelanggaranKuningKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.059) as jumlah_pelanggaran_kuning'))
                                    ->where('sub_kriteria_id', 9)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Provokasi Kartu Kuning
    static function jumlahProvokasiKuningKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.274) as jumlah_provokasi_kuning'))
                                    ->where('sub_kriteria_id', 10)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Memukul Kartu Kuning
    static function jumlahMemukulKuningKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.530) as jumlah_memukul_kuning'))
                                    ->where('sub_kriteria_id',11)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Selebrasi Kartu Kuning
    static function jumlahSelebrasiKuningKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.138) as jumlah_selebrasi_kuning'))
                                    ->where('sub_kriteria_id', 12)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //KARTU MERAH ----------------------------------------------------------------
    //Jumlah Pelanggaran Kartu Merah
    static function jumlahPelanggaranMerahKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.059) as jumlah_pelanggaran_merah'))
                                    ->where('sub_kriteria_id', 13)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    //Jumlah Provokasi Kartu Merah
    static function jumlahProvokasiMerahKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.274) as jumlah_provokasi_merah'))
                                    ->where('sub_kriteria_id', 14)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Memukul Kartu Merah
    static function jumlahMemukulMerahKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.530) as jumlah_memukul_merah'))
                                    ->where('sub_kriteria_id', 15)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }

    //Jumlah Selebrasi Kartu Merah
    static function jumlahSelebrasiMerahKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.138) as jumlah_selebrasi_merah'))
                                    ->where('sub_kriteria_id', 16)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }


    //ATTITUDE PEMAIN-------------------------------------------------------------
    //WAKTU
    static function jumlahWaktuPemainKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.703) as jumlah_waktu_pemain'))
                                    ->where('sub_kriteria_id', 20)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    static function jumlahRespectPemainKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.115) as jumlah_respect_pemain'))
                                    ->where('sub_kriteria_id', 21)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    static function jumlahMentalPemainKiper()
    {
        $data = HasilSubKriteria::select('pemain_id', 'musim', DB::raw('SUM(jumlah*0.182) as jumlah_mental_pemain'))
                                    ->where('sub_kriteria_id', 22)
                                    ->groupBy('pemain_id', 'musim')->get();
        return $data;
    }
    

    
}
