<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carsort extends Model
{
    protected $table = 'cars';

    protected $fillable = [
        'name' ,'created_at' , 'updated_at'
    ];
}
