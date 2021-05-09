<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storeorder extends Model
{
    protected $table = 'storeorders';

    protected $fillable = [
        'store_id' ,'total_price', 'paid_price' , 'remaining_price', 'created_at' , 'updated_at'
  ];

    protected $guarded = [];


    public function store()
    {
        return $this->belongsTo(User::class);
    }

    public function mainproducts()
    {
        return $this->belongsToMany(Mainproduct::class, 'mainproduct_storeorder')->withPivot('quantity','unitprice');

    }//end of products
}
