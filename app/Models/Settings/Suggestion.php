<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suggestion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'suggestions';
    protected $fillable = ['email', 'nama', 'photo', 'content', 'status'];
    protected $guarded = ['id'];
}
