<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name' ,'created_at' , 'updated_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_country')->withPivot('price');

    }//end of products
    public function stores()
    {
        return $this->hasMany(User::class);

    }//end of stores


}
