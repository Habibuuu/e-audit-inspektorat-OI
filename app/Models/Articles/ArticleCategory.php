<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'articles_categories';
    protected $guard = [];

    public function Parent()
    {
        return $this->hasOne('App\Models\Articles\ArticleCategory', 'id', 'parent_id');
    }

    public function Childs()
    {
        return $this->hasMany('App\Models\Articles\ArticleCategory', 'parent_id', 'id');
    }

    // public function Articles()
    // {
    //     return $this->hasMany(Article::class, 'category_id', 'id');
    // }

    public function Articles()
    {
        return $this->belongsTo('App\Models\Articles\Article', 'id', 'category_id');
    }
}
