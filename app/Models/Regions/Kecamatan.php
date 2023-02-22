<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'wilayah_kecamatan';
    protected $guarded = [
        'id',
        'kabupaten_id',
        'nama'
    ];

    public function Kab()
    {
        return $this->hasOne('App\Models\Regions\Kabupaten','id','kabupaten_id');
    }
}
