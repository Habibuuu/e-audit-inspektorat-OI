<?php

namespace App\Models\Util;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banners extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'banners';
    protected $fillable = [
        'title',
        'slug',
        'caption',
        'filename',
        'status',
    ];
}
