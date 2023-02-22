<?php

namespace App\Models\Posting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Videos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'videos';
    protected $fillable = [
        'title',
        'slug',
        'youtube_id',
        'description',
        'status',
    ];
}
