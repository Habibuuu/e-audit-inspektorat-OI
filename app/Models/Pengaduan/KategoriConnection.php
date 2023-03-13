<?php

namespace App\Models\Pengaduan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriConnection extends Model
{
    use HasFactory;
    protected $table = 'pengaduan_con_kategori';
    protected $fillable = [
        'pengaduan_id',
        'kategori_id',
    ];
    public $timestamps = false;
}
