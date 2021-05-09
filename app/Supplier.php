<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
          'name'  , 'phone' , 'address', 'email' 
    ];

    public function store()
    {
        return $this->belongsTo(User::class);
    }
   
    public function orders()
    {
        return $this->hasMany(Order::class);

    }//end of orders
}
