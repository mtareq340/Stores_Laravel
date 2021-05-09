<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
          'name'  , 'phone' , 'store_id', 'created_at' , 'updated_at'
    ];

    public function store()
    {
        return $this->belongsTo(User::class);
    }
    public function technical()
    {
        return $this->belongsTo(Technical::class, 'technical_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);

    }//end of orders
    public function cars()
    {
        return $this->belongsToMany(Car::class, 'client_car')->withPivot('carnumber','carcolor_id','id');
    }

}
