<?php

namespace App\Http\Controllers\Cacheir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\Shift;
use App\Order;

class ShiftController extends Controller
{
    public function create_shift()
    {
        $start_time = Carbon::now()->toDateTimeString();
        $shift = new Shift();
        $shift->cacheir_id = Auth::user()->id;
        $shift->store_id = Auth::user()->store_id;
        $shift->start_date = $start_time;
        $shift->start = 1;
        $shift->save();

        return response()->json($shift);  
    }

    public function end_shift()
    {
        $end_date = Carbon::now()->toDateTimeString();
        $shift = Shift::latest()->where('cacheir_id', Auth::user()->id)->first();


        $orders= DB::select('SELECT
         technicals.id,technicals.name,
        COUNT(*) as orderscount,
        SUM(orders.price_after_discount)as total_price
        from technicals
        JOIN orders 
        ON technicals.id = orders.technical_id
        WHERE orders.created_at BETWEEN "'.$shift->start_date.'" AND "'.$end_date.'"
            AND orders.store_id = "'.Auth::user()->store_id.'"
            AND orders.confirmed=1
        GROUP BY technicals.id;
    ');
        $shiftOrders = Order::whereBetween('created_at', [$shift->start_date, $end_date])
        ->where('store_id',Auth::user()->store_id)->get();
        $total_price = 0;
        foreach($shiftOrders as $order)
        {
            $total_price += $order->price_after_discount;
        }
        $shift->end_date = $end_date;
        $shift->start = 0;
        $shift->total_price = $total_price;
        $shift->update();

        return response()->json($orders);  
    }
}
