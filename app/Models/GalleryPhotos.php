<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhotos extends Model
{
    use HasFactory;
    protected $table = "gallery_photos";
    protected $fillable = [
        'id_gallery',
        'photo',
    ];
}
