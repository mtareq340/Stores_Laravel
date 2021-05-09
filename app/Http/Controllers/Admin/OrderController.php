<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Order;
use App\Misorder;

class OrderController extends Controller
{
   
    public function index(Request $request){    
        if (! Gate::allows('عرض_الفواتير')) {
            return abort(401);
        }
        $search = $request->input('search');

        $orders = Order::query()
            ->where('id', 'LIKE', "%{$search}%")
            ->paginate(10);
     

        // $orders = Order::all();
 
        return view('admin.orders.index',compact('orders'));
    }

    public function discount(Request $request){    
        if (! Gate::allows('عرض_الفواتير')) {
            return abort(401);
        }
        $search = $request->input('search');

        $orders = Order::query()
            ->where('discount', '>', 0)->where('discount_confirmed', 0)->where('id', 'LIKE', "%{$search}%")
            ->latest()->paginate(10);
      
        return view('admin.orders.discount',compact('orders'));
    }
    public function misOrders(Request $request){    
        if (! Gate::allows('عرض_الفواتير')) {
            return abort(401);
        }
        $search = $request->input('search');

        $orders = Misorder::query()
            ->where('id', 'LIKE', "%{$search}%")
            ->paginate(10);
      
        return view('admin.orders.misorders',compact('orders'));
    }
    public function discountConfirm(Request $request)
    {
        $order = Order::FindOrFail($request->order_id);
        $order->discount = $request->discount;
        $order->price_after_discount = $order->total_price - $request->discount;
        $order->discount_confirmed = 1;
        $order->save();

        session()->flash('success', __('تم تأكيد الطلب'));
        return redirect()->route('admin.orders.discount')->with(['success' => 'تم تأكيد الطلب']);

    }

    public function deleteDiscount($id){
        if (! Gate::allows('عرض_الفواتير')) {
            return abort(401);
        }
        
        try{
            $order = order::find($id);
            if(!$order){
                return redirect()->route('admin.orders.discount',$id)->with(['error' => 'هذا الطلب غير موجود']);
            }
        //update in db
            $order->discount = 0;
            $order->discount_confirmed = 0;
            $order->save();
            return redirect()->route('admin.orders.discount')->with(['success' => 'تم الغاء الطلب بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.orders.discount')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
