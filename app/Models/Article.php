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
        'imatge', 
        'nom_usuari'
    ];

    public $timestamps = true;

    //relació amb la taula d'usuari pel nom de mecanic
    public function usuari(){
        return $this->belongsTo(Usuari::class, 'nom_usuari', 'nombreUsuario');
    }

}
