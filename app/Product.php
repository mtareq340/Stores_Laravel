<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id' , 'name', 'price_value', 'countable', 'created_at' , 'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function countries()
    {
        return $this->belongsTo(Country::class, 'product_country')->withPivot('price');

    }//end of products
    public function getChangedPrice(){
        if($this->price_value == 0 )
        return 'السعر ثابت تابع للمنطقة';
        elseif($this->price_value == 1)
        return 'السعر تابع للفرع';
        elseif($this->price_value == 2)
        return 'السعر عند الدفع';
        else { return ''; }
    }
    public function getCountable(){
        return $this->countable == 0 ? '  لا يوجد مخزن للخدمة': ' يوجد مخزن للخدمة';
    }
}
