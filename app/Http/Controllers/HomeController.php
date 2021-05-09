<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Country;
use App\Technical;
use App\Product;
use App\Shift;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  
    public function index()
    {
       

        $categories = Category::all();
        $country = Country::FindOrFail(Auth::user()->country_id);
        $store = User::FindOrFail(Auth::user()->id);
        $storeproducts = $store->productsprice()->get();
        $products_during_paid = Product::where('price_value', 2)->get();
        $technicals = Technical::where('store_id', Auth::user()->id )->get()
        ->pluck('name', 'id')->prepend('-- من فضلك اختار --', '');
        $shift = Shift::latest()->where('store_id', Auth::user()->id)->first();
        // dd($shift);
        return view('store.home',compact('categories','technicals','country','storeproducts','products_during_paid', 'shift'));
    }
}
