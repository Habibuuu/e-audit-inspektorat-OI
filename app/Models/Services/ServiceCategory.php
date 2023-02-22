<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'services_categories';
    protected $guard = [];

    public function Category()
    {
        return $this->hasMany('App\Models\Services\Service', 'category_id', 'id');
    }
}
