<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table='detail_transaksis';
    protected $primaryKey='id_detail_transaksi';
    public $timestamps=false;
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id_transaksi', 'id_menu', 'jumlah', 'total_harga'
    ];
}
