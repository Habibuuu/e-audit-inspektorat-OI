<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = "gallery";
    protected $fillable = [
        'title',
        'seo',
        'views',
        'status',
        'thumbnail',
        'date',
    ];

    public function Photos()
    {
        return $this->hasMany(GalleryPhotos::class,'id_gallery', 'id');
    }

    public function Thumbnail()
    {
        return $this->hasOne(GalleryPhotos::class,'id_gallery', 'id')->inRandomOrder();
    }
}
