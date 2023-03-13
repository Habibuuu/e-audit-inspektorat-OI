<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wilayah extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wilayah';
    protected $fillable = [
        'name',
        'status',
    ];

    public function getWilayah()
    {
        return $this->belongsToMany('App\Models\Pengaduan\PengaduanModel','pengaduan_con_wilayah','wilayah_id','pengaduan_id')->withPivot('wilayah_id', 'pengaduan_id');
    }
}
