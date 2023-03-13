<?php

namespace App\Models\Pengaduan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahConnection extends Model
{
    use HasFactory;
    protected $table = 'pengaduan_con_wilayah';
    protected $fillable = [
        'pengaduan_id',
        'wilayah_id',
    ];
    public $timestamps = false;
}
