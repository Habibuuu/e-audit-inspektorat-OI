<?php

namespace App\Models\Persons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonsTypes extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'persons_types';
    protected $guarded = [];

    public function toPersonCon()
    {
        return $this->hasMany('App\Models\Persons\PersonsTypeConnections', 'type_id', 'id');
    }
}
