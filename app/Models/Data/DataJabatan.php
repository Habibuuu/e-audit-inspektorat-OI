<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataJabatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'data_jabatan';
    protected $guarded = [];

    public function toData()
    {
        return $this->hasMany('App\Models\Data\DataJabatanKoneksi', 'jabatan_id', 'id');
    }
}
