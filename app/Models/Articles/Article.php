<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'articles';
    protected $fillable = [
        'type_id',
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'description',
        'content',
        'status',
        'is_recommend',
        'is_auto_publish',
        'published_at',
    ];

    public function Author()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function Type()
    {
        return $this->hasOne('App\Models\Articles\ArticleType', 'id', 'type_id');
    }

    public function Category()
    {
        return $this->hasOne('App\Models\Articles\ArticleCategory', 'id', 'category_id');
    }

    public function Tags()
    {
        return $this->belongsToMany('App\Models\Articles\TagsConnection', 'articles_tags_connections', 'article_id', 'tag_id', 'id');
    }

    public function Tag()
    {
        return $this->hasMany('App\Models\Articles\TagsConnection','article_id','id');
    }

    public function getTags()
    {
        return $this->belongsToMany('App\Models\Articles\ArticleTags','articles_tags_connections','article_id','tag_id')->withPivot('article_id', 'tag_id');
    }
}

