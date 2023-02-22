<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'services_contents';
    protected $guard = [];

    public function Type()
    {
        return $this->hasOne('App\Models\Services\Service', 'id', 'service_id');
    }

    public function Author()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
