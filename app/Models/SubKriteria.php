<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $table = "sub_kriteria";
    protected $guarded =[];
    
    public function hasil_sub_pemain()
    {
        return $this->belongsToMany(HasilSubKriteria::class, 'id', 'sub_kriteria_id', 'pemain_id')->withPivot('musim', 'jumlah', 'created_at');
    }
}
