<?php

namespace App\Http\Controllers\Cacheir;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Order;
class DashboardController extends Controller
{
    public function index(Request $request){
        
        // $orders = Order::orderBy('id', 'DESC')->where('store_id', Auth::user()->store_id)->whereHas('client', function ($q) use ($request) {

        //     return $q->where('name', 'like', '%' . $request->search . '%')
        //     ->orWhere('phone', 'like', '%' . $request->search . '%')
        //     ->orWhere('carnumber', 'like', '%' . $request->search . '%');

        // })->paginate(10);
        $search = $request->input('search');

        $orders = Order::query()
            ->where('store_id', Auth::user()->store_id)->where('id', 'LIKE', "%{$search}%")
            ->latest("id")
            ->paginate(10);
     
        return view('cacheir/index',compact('orders'));
    }

   
}
