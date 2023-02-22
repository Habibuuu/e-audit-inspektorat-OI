<?php

namespace App\Models\Persons;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persons extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'persons';
    protected $guarded = [];


    public function Jenis()
    {
        return $this->belongsToMany('App\Models\Persons\PersonsTypeConnections','persons_types_connections','person_id','type_id');
    }

    public function Jen()
    {
        return $this->hasMany('App\Models\Persons\PersonsTypeConnections','person_id','id');
    }

    public function getJenis()
    {
        return $this->belongsToMany('App\Models\Persons\PersonsTypes','persons_types_connections','person_id','type_id')->withPivot('person_id', 'type_id');
    }

    public function Rank()
    {
        return $this->belongsToMany('App\Models\Persons\PersonsRankConnections','persons_ranks_connections','person_id','rank_id');
    }

    public function Ran()
    {
        return $this->hasMany('App\Models\Persons\PersonsRankConnections','person_id','id');
    }

    public function getRanks()
    {
        return $this->belongsToMany('App\Models\Persons\PersonsRanks','persons_ranks_connections','person_id','rank_id')->withPivot('person_id', 'rank_id');
    }

    public function Kelas()
    {
        return $this->hasOne('App\Models\Classes\Classes','id','class_id');
    }

    public function Asrama()
    {
        return $this->hasOne('App\Models\Asrama\Asrama','id','asrama_id');
    }

    public function asalKel()
    {
        return $this->hasOne('App\Models\Regions\Desa','id','from_region_id');
    }

}
