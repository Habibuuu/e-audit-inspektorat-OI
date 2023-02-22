<?php

namespace App\Models\Util;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuPortals extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'menu_portals';
    protected $guard = [];

}
