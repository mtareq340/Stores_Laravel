<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mainproduct extends Model
{
    protected $table = 'mainproducts';

    protected $fillable = [
        'id','category_id' , 'name','quantity', 'created_at' , 'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function countries()
    {
        return $this->belongsTo(Country::class, 'product_country')->withPivot('price');

    }//end of products
}
