<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $table='mejas';
    protected $primaryKey='id_meja';
    public $timestamps=false;
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'nomor_meja', 'status_meja'
    ];

    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
