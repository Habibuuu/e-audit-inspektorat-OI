<?php

namespace App\Models\Util;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortalCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'portals_categories';
    protected $guard = [];

    public function Parent()
    {
        return $this->hasOne('App\Models\Util\PortalCategory', 'id', 'parent_id');
    }

    public function Childs()
    {
        return $this->hasMany('App\Models\Util\PortalCategory', 'parent_id', 'id');
    }

    public function Portals()
    {
        return $this->hasMany('App\Models\Util\MenuPortals', 'category_id', 'id');
    }
}
