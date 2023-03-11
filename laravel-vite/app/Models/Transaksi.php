<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table='transaksis';
    protected $primaryKey='id_transaksi';
    public $timestamps=false;
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'tgl_transaksi', 'id_user', 'id_meja', 'nama_pelanggan', 'status'
    ];

    // public function detail_transaksi()
    // {
    //     return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    // }

    // public function user()
    // {
    //     return $this->hasOne(User::class);
    // }

    // public function meja()
    // {
    //     return $this->hasOne(Meja::class);
    // }
}
