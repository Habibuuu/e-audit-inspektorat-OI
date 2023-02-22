<?php

namespace App\Models\Asrama;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asrama extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'asrama';
    protected $guarded = [];

    public function toData()
    {
        return $this->hasMany('App\Models\Data\DataSiswa', 'asrama_id', 'id');
    }
}
