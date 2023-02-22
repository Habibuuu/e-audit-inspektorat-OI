<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalNews extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'portal_news';
    protected $fillable = [
        'parent_id',
        'sort',
        'url',
        'name',
        'photo',
        'icon',
        'slug',
        'status',
    ];

    public function Parent()
    {
        return $this->hasOne('App\Models\PortalNews', 'id', 'parent_id');
    }

    public function Childs()
    {
        return $this->hasMany('App\Models\PortalNews', 'parent_id', 'id')->orderBy('sort');
    }
}
