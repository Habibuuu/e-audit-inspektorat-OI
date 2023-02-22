<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'wilayah_provinsi';
    protected $guarded = [
        'id',
        'nama'
    ];
}
