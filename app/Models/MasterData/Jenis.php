<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jenis extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jenis';
    protected $fillable = [
        'name',
        'status',
    ];

    public function getJenis()
    {
        return $this->belongsToMany('App\Models\Pengaduan\PengaduanModel','pengaduan_con_jenis','jenis_id','pengaduan_id')->withPivot('jenis_id', 'pengaduan_id');
    }
}
