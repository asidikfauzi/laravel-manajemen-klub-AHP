<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klub extends Model
{
    use HasFactory;
    
    protected $table = "klub";
    protected $guarded =[];
    
    public function struktur_klub()
    {
        return $this->hasOne(StrukturKlub::class, 'id', 'klub_id');
    }

    public function kontrak_pemain()
    {
        return $this->belongsToMany(Kontrak::class, 'id', 'klub_id', 'pemain_id')->withPivot('gaji', 'awal_kontrak', 'akhir_kontrak', 'foto_kontrak');
    }
}
