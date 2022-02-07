<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturKlub extends Model
{
    use HasFactory;

    protected $table = "struktur_klub";
    protected $guarded =[];

    public $incrementing = false;
    protected $keyType = "string";
}
