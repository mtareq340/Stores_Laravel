<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplierorder extends Model
{
    protected $table = 'supplierorders';

    protected $fillable = [
        'supplier_id' ,'total_price', 'paid_price' , 'remaining_price', 'created_at' , 'updated_at'
  ];

    protected $guarded = [];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function mainproducts()
    {
        return $this->belongsToMany(Mainproduct::class, 'mainproduct_supplierorder')->withPivot('quantity','unitprice');

    }//end of products
}
