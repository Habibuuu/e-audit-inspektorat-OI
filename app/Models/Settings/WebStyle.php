<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebStyle extends Model
{
    use HasFactory;
    protected $table = 'website_style';
    protected $fillable = [
        'main_banner',
        'color_1',
        'color_1_active',
        'color_2',
        'color_2_active',
        'black',
        'white',
        'background_color',
        'font_style',
    ];
    public $timestamps = false;
}
