<?php

namespace App\Models\Persons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonsRankConnections extends Model
{
    use HasFactory;
    protected $table = 'persons_ranks_connections';
    protected $fillable = [
        'person_id',
        'rank_id',
    ];
    public $timestamps = false;
}
