<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";
    protected $guarded =[];

    protected $primaryKey = "username";
    protected $keyType = "string";

    public function klub()
    {
        return $this->hasMany(Klub::class, "users_username", "username");
    }
    public function pemain()
    {
        return $this->hasMany(Pemain::class, "users_username", "username");
    }
    public function berita_dan_aktivitas()
    {
        return $this->hasMany(BeritaDanAktivitas::class, "users_username", "username");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'role_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
