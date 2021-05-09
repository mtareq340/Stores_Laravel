<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Store;
use App\Technical;
use App\Client;
use App\Category;
use App\Product;
use App\Supplier;
use App\Country;
use App\Role;


class DashboardController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    public function index(){     
        $stores = Role::where('title', 'store')->first()->users()->get();
        $technicals = Technical::all();
        $clients = Client::all();
        $categories = Category::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        $countries = Country::all();

        return view('admin/dashboard',compact('technicals','clients','categories','products','stores','suppliers','countries'));
    }
}
