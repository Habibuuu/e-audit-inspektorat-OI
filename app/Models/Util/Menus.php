<?php

namespace App\Models\Util;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'menus';
    protected $fillable = [
        'parent_id',
        'sort',
        'url',
        'name',
        'slug',
        'status',
    ];

    public function Parent()
    {
        return $this->hasOne('App\Models\Util\Menus', 'id', 'parent_id');
    }

    public function Childs()
    {
        return $this->hasMany('App\Models\Util\Menus', 'parent_id', 'id')->orderBy('sort');
    }
}
