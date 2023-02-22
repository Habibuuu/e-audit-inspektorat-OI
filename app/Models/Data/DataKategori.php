<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataKategori extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'data_kategori';
    protected $guarded = [];

    public function toData()
    {
        return $this->hasMany('App\Models\Data\DataKategoriKoneksi', 'kategori_id', 'id');
    }
}
