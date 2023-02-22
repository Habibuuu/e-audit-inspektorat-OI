<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = [
        'nama',
        'alamat',
        't_lahir',
        'j_kelamin',
        'no_hp',
        'pekerjaan',
        'email',
        'photo',
        'j_gagasan',
        'n_gagasan',
        'status',
    ];
}
