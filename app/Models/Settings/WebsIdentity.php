<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsIdentity extends Model
{
    use HasFactory;
    protected $table = 'website_identity';
    protected $fillable = [
        'name',
        'description',
        'favicon',
        'logo',
        'email',
        'address',
        'googlemap',
        'telephone',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
    ];
    public $timestamps = false;
}
