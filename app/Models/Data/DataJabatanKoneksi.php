<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJabatanKoneksi extends Model
{
    use HasFactory;
    protected $table = 'data_jabatan_koneksi';
    protected $fillable = [
        'data_id',
        'jabatan_id',
    ];
    public $timestamps = false;
}
