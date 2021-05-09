<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

//     protected $fillable = [
//         'total_price' ,'store_id', 'technical_id' , 'created_at' , 'updated_at'
//   ];

    protected $guarded = [];


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
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity','price');

    }//end of products

}
