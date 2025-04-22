<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    //especifico la clau primaria perque la default que espera 
    //laravel es "id" i no "ID" i em dona error a l'hora de fer us del token de recuperació
    protected $primaryKey = 'ID';

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
