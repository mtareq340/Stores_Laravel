<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Misorder extends Model
{
    protected $table = 'misorders';
    protected $guarded = [];

    
    public function order()
    {
        return $this->belongsTo(Order::class);
    } 
     public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function technical()
    {
        return $this->belongsTo(Technical::class, 'technical_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_misorder')->withPivot('quantity','price');

    }//end of products
}
