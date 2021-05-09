<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technical extends Model
{
    protected $table = 'technicals';

    protected $fillable = [
        'store_id' , 'name' ,'email' , 'password', 'phone' , 'created_at' , 'updated_at'
    ];

    public function store()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders', 'technical_id');

    }//end of orders

}
