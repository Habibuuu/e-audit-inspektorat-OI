<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'wilayah_desa';
    protected $guarded = [
        'id',
        'kecamatan_id',
        'nama'
    ];

    public function Kec()
    {
        return $this->hasOne('App\Models\Regions\Kecamatan','id','kecamatan_id');
    }
}
