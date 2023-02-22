<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleTags extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'articles_tags';
    protected $fillable = [
        'name',
        'slug',
    ];

    public function Articles()
    {
        return $this->belongsToMany('App\Models\Articles\Article','articles_tags_connections','tag_id','article_id')->withPivot('tag_id', 'article_id');
    }
}
