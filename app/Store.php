<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Store extends Model
{

    public function technicals()
    {
        return $this->hasMany(Lesson::class);
    }

    public function mainproducts()
    {
        return $this->belongsToMany(Mainproduct::class, 'store_mainproducts')->withPivot('quantity');

    }//end of mainproducts

    
}   
