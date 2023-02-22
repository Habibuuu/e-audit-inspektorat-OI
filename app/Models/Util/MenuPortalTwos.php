<?php

namespace App\Models\Util;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuPortalTwos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'menu_portaltwos';
    protected $guard = [];

    protected $fillable = [
        'name',
        'url',
        'caption',
        'image',
        'icon',
        'sort',
        'status'
    ];
}
