<?php

namespace App\Models\Posting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infographics extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'infographics';
    protected $fillable = [
        'title',
        'slug',
        'filename',
        'description',
        'status',
    ];
}
