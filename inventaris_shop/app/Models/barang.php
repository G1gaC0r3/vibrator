<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_barang',
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'jumlah_barang',
        'terpakai',
    ];
    protected $guarded = ['id_barang'];
    use HasFactory;
}
