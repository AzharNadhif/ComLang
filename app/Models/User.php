<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nama', 'notelp', 'email', 'password',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_user');
    }
}
