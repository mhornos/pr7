<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuari extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuaris';

    //especifico la clau primaria perque la default que espera 
    //laravel es "id" i no "ID" i em dona error a l'hora de fer us del token de recuperació
    protected $primaryKey = 'ID';

    //atributs de la taula
    protected $fillable = [
        'nombreUsuario',
        'contrasenya',
        'correo',
        'ciutat',
        'imatge',
        'token',
        'expiracio_token',
        'remember_token',
        'remember_token_expiracio',
    ];

    //atributs que han de ser ocults
    protected $hidden = [
        'contrasenya',
        'remember_token',
        'token',
    ];

    //atributs que han de ser convertits a un altre tipus
    protected $casts = [
        'expiracio_token' => 'datetime',
        'remember_token_expiracio' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->contrasenya;
    }
}
