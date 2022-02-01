<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    protected $table = "pemain";
    protected $guarded =[];

    public $incrementing = false;

    use HasFactory;

    public function kontrak_klub()
    {
        return $this->belongsToMany(Kontrak::class, 'id', 'pemain_id', 'klub_id')->withPivot('gaji', 'awal_kontrak', 'akhir_kontrak', 'foto_kontrak');
    }
    public function hasil_sub_kriteria()
    {
        return $this->belongsToMany(HasilSubKriteria::class, 'id', 'pemain_id', 'sub_kriteria_id')->withPivot('musim', 'jumlah', 'created_at');
    }
}
