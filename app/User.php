<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
use App\Country;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function isAdmin()
    {
        return $this->roles()->where('role_id', 1)->first();
    }
    public function isCacheir()
    {
        return $this->roles()->where('role_id', 2)->first();
    }
    public function isStore()
    {
        return $this->roles()->where('role_id', 3)->first();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_product','store_id','product_id')->withPivot('price');
    	
    }
    public function store()
    {
        return $this->belongsTo('App\User', 'store_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');

    }//end of country

    public function mainproducts()
    {
        return $this->belongsToMany(Mainproduct::class, 'store_mainproducts','store_id','mainproduct_id')->withPivot('quantity');

    }//end of mainproducts
    public function productsprice()
    {
        return $this->belongsToMany(Product::class, 'store_product','store_id','product_id')->withPivot('price');

    }//end of mainproducts

    public function hasRole($role)
    {
        if($this->roles()->where('title', $role)->first()){
            return true;
        }
        return false;
    }
   
}
