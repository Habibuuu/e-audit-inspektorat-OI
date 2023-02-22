<?php

namespace App\Models\Util;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Links extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'links';
    protected $fillable = ['title', 'url', 'image', 'description', 'keywords', 'status', 'user_id'];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
