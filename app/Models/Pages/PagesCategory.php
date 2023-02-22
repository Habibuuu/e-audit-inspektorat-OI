<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagesCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pages_categories';
    protected $guard = [];
    public function Parent()
    {
        return $this->hasOne('App\Models\Pages\PagesCategory', 'id', 'parent_id');
    }

    public function Childs()
    {
        return $this->hasMany('App\Models\Pages\PagesCategory', 'parent_id', 'id');
    }

    public function Pages()
    {
        return $this->hasMany('App\Models\Pages\Pages', 'category_id', 'id');
    }
}
