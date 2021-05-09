<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carcolor extends Model
{
    protected $table = 'carcolors';

    protected $fillable = [
        'name' ,'created_at' , 'updated_at'
    ];
}
