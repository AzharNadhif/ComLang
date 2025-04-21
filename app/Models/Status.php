<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    public $timestamps = false;

    protected $fillable = [
        'nama_status'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_status');
    }
}
