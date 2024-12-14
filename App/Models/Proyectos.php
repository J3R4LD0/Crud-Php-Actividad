<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model {
    protected $table = 'proyectos'; // Nombre de la tabla

    // Desactivar las marcas de tiempo
    public $timestamps = false;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_finalizacion',
        'codigo_empresa'
    ];
}
