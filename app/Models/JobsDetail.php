<?php

namespace App\Models;

class JobsDetail extends BaseModel
{
    protected $table = 'job_detail';

    protected $fillable = [
        'tareas',
        'costo_hora',
        'puesto',
        'moneda',
        'pais',
        'job_id'
    ];
    public $timestamps = false;
}
