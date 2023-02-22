<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{
    
    use HasFactory, SoftDeletes;
    
    protected $removeViewsOnDelete = true;
    protected $table = 'pages';
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'status',
    ];

    // public $viewable;

    // public function __construct($viewable)
    // {
    //     $this->viewable = $viewable;
    // }

    public function Author()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function Category()
    {
        return $this->hasOne('App\Models\Pages\PagesCategory', 'id', 'category_id');
    }
    
}
