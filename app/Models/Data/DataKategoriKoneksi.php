<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKategoriKoneksi extends Model
{
    use HasFactory;
    protected $table = 'data_kategori_koneksi';
    protected $fillable = [
        'type',
        'data_id',
        'kategori_id',
    ];
    public $timestamps = false;
}
