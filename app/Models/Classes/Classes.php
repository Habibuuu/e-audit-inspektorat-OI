<?php

namespace App\Models\Classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'classes';
    protected $guarded = [];

    public function toData()
    {
        return $this->hasMany('App\Models\Data\DataSiswa', 'kelas_id', 'id');
    }
}
