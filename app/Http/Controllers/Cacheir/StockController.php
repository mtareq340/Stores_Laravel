<?php

namespace App\Http\Controllers\Cacheir;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Order;
use App\User;
class StockController extends Controller
{
    public function index(Request $request){
     
        $store = User::FindOrFail(Auth::user()->store_id);
        $mainproducts = $store->mainproducts()->get();
 
        return view('cacheir/stock', compact('mainproducts'));
    }

   
}
