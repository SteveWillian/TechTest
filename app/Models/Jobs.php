<?php

namespace App\Models;

class Jobs extends BaseModel
{
    protected $table = 'jobs';


    protected $fillable = [
        'queue',
        'payload',
    ];

    public $timestamps = false;
}
