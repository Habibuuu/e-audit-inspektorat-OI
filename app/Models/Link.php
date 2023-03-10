<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'links';
    protected $fillable = [
        'title',
        'slug',
        'filename',
        'url',
        'description',
        'status',
    ];
}
