<?php

namespace App\Models\Persons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonsTypeConnections extends Model
{
    use HasFactory;
    protected $table = 'persons_types_connections';
    protected $fillable = [
        'person_id',
        'type_id',
    ];
    public $timestamps = false;
}
