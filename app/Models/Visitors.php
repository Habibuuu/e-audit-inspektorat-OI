<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    use HasFactory;
    protected $fillable = [
        'datetime',
        'date',
        'ip_address',
        'url',
        'referal',
        'os',
        'device',
        'browser',
        'country',
        'country_code',
        'tipe',
        'visit',
    ];
    public $timestamps = false;
}
