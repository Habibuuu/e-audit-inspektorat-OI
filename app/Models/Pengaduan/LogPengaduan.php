<?php

namespace App\Models\Pengaduan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogPengaduan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'log_pengaduan';
    protected $fillable = [
        'pengaduan_id',
        'status_log',
        'tgl_log',
    ];
}
