<?php

namespace App\Models\Regions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'wilayah_kabupaten';
    protected $guarded = [
        'id',
        'provinsi_id',
        'nama'
    ];

    public function Prov()
    {
        return $this->hasOne('App\Models\Regions\Provinsi','id','provinsi_id');
    }
}
