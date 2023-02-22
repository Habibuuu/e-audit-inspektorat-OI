<?php

namespace App\Models\Posting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'galleries_categories';
}
