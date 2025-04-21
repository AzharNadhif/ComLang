<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;
    
    protected $fillable = [
        'id_user', 'id_status', 'total', 'tanggal_pesanan', 'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pesanan');
    }
}
