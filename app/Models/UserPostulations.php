<?php

namespace App\Models;

class UserPostulations extends BaseModel
{
    protected $table = 'user_postulations';

    protected $fillable = [
        'jobs_id',
        'user_id',
    ];

    public $timestamps = false;
}
