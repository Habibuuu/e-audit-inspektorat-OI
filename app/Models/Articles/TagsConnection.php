<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsConnection extends Model
{
    use HasFactory;
    protected $table = 'articles_tags_connections';
    protected $fillable = [
        'article_id',
        'tag_id',
    ];
    public $timestamps = false;
}
