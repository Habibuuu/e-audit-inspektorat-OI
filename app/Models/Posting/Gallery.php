<?php

namespace App\Models\Posting;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'galleries';
    protected $guarded = [];

    public function Photos()
    {
        return $this->hasMany(GalleryPhoto::class, 'gallery_id');
    }

    public function Thumbnail()
    {
        return $this->hasOne(GalleryPhoto::class, 'gallery_id')->inRandomOrder()->select('image');
    }

    public function Category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }

    public function Author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
