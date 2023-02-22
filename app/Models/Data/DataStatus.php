<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'data_status';
    protected $guarded = [];
}
