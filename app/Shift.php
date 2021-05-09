<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';

    protected $fillable = [
        'cacheir_id' ,'store_id' , 'start_date', 'end_date', 'start', 'end', 'created_at' , 'updated_at'
    ];
}
