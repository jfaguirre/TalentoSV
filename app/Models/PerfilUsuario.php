<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{   
    
    protected $fillable = [

        'telefono',
        'nacionalidad',
        'genero',
        'foto',
        'cv_path',
        'portafolio_url',
        'linkedin',
        'facebook',
        'x',
        'instagram',
        'tiktok',
        'youtube',
        'titulo_profesional',
        'resumen',
        'disponible',
        'modalidad_preferida',
        'perfil_publico',
        'mostrar_telefono',
        'id_user',
        'id_departamento',
        'id_municipio',
        'id_distrito',
        'id_nivel_academico',
        
    ];
}
