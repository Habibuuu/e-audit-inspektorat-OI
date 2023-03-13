<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategori';
    protected $fillable = [
        'name',
        'status',
    ];

    public function getKategori()
    {
        return $this->belongsToMany('App\Models\Pengaduan\PengaduanModel','pengaduan_con_kategori','kategori_id','pengaduan_id')->withPivot('kategori_id', 'pengaduan_id');
    }
}
