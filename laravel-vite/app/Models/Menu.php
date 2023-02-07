<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table='menus';
    protected $primaryKey='id_menu';
    public $timestamps=false;
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'nama_menu', 'jenis', 'deskripsi', 'gambar', 'harga'
    ];
}
