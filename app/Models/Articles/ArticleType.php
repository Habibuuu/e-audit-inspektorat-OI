<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'articles_types';
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
    ];

    public function Parent()
    {
        return $this->hasOne('App\Models\Articles\ArticleType', 'id', 'parent_id');
    }

    public function Childs()
    {
        return $this->hasMany('App\Models\Articles\ArticleType', 'parent_id', 'id');
    }

    public function Articles()
    {
        return $this->hasMany('App\Models\Articles\Article', 'type_id', 'id');
    }
}
