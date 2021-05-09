<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';

    protected $fillable = [
        'carnumber' , 'carsort'  , 'carcolor_id' , 'client_id', 'created_at' , 'updated_at'
    ];

}
