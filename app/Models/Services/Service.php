<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'services';
    protected $guard = [];

    public function Category()
    {
        return $this->hasOne('App\Models\Services\ServiceCategory', 'id', 'category_id');
    }

    public function Content()
    {
        return $this->hasMany('App\Models\Services\ServiceContent', 'service_id', 'id');
    }
}
