<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;
    
    protected $table = "kontrak";
    protected $guarded =[];
    protected $primaryKey = 'pemain_id';
    protected $keyType = "string";
}
