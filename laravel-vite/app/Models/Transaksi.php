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
        'tgl_transaksi', 'nama_pelanggan', 'status'
    ];
}
