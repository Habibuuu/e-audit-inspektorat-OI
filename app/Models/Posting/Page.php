<?php

namespace App\Models\Posting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pages';
    protected $fillable = ['title', 'slug', 'thumbnail', 'content', 'user_id'];

    public function Author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
