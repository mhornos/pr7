<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    protected $fillable = [
        'marca',
        'model',
        'any',
        'color',
        'matricula',
        'nom_usuari',
        'imatge',
    ];

    public $timestamps = true;
}
