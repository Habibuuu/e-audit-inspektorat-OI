<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStatusKoneksi extends Model
{
    use HasFactory;
    protected $table = 'data_status_koneksi';
    protected $fillable = [
        'data_id',
        'status_id',
    ];
    public $timestamps = false;
}
