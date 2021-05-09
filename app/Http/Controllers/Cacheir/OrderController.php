<?php

namespace App\Http\Controllers\Cacheir;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\User;
use App\Product;
use App\Misorder;
class OrderController extends Controller
{
    public function products(Order $order)
    {
        $products = $order->products;
        return view('cacheir.order_products', compact('order', 'products'));

    }//end of products
    public function priceConfirm(Request $request, $order_id)
    {
        $order = Order::FindOrFail($order_id);
        $total_price = 0;

        if($request->products)
        {
            foreach ($request->products as $id => $price) {
                $product = Product::FindOrFail($id);
                        
                    // $item = $store->products()->where('product_id', $id)->first();
                    $itemorder = $order->products()->where('product_id', $id)->first();

                    $itemorder->pivot->price = $price['price'];
                    $itemorder->pivot->save();
                
                $total_price += $itemorder->pivot->price * $itemorder->pivot->quantity;
            
            }//end of foreach
        }

        $order->update([
            'total_price' => $order->total_price + $total_price,
            'price_confirmed' => 1
        ]);
        return redirect()->route('cacheir')->with(['success' => 'تم تحديث اسعار الفاتورة بنجاح']);

    }
    public function misProducts($id)
    {
        $misorder = Misorder::find($id);
        $products = $misorder->products;
        return view('cacheir.misorder_products', compact('misorder', 'products'));

    }//end of products

    public function misOrders(Request $request){     
        $misorders = Misorder::orderBy('id', 'DESC')->where('store_id', Auth::user()->store_id)
        ->whereHas('client', function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('order_id', 'like', '%' . $request->search . '%');
        })->paginate(10);

        return view('cacheir/misorders',compact('misorders'));
    }

    public function assignOrder()
    {
        return view('cacheir/assignorder');
    }

    public function destroy(Order $order)
    {
        $store = User::FindOrFail(Auth::user()->store_id);

        foreach($order->products as $product)
        {

            if($product->countable)
            {
                $item = $store->mainproducts()->where('mainproduct_id', $product->id)->first();
                $item->pivot->quantity += $product->pivot->quantity;
                $item->pivot->save();
              
            }
        }
       

        $misorder = new Misorder();
        $misorder->order_id = $order->id;
        $misorder->technical_id = $order->technical_id;
        $misorder->store_id = $order->store_id;
        $misorder->total_price = $order->total_price;
        $misorder->save();
        $misorder->products()->attach($order->products);


        $order->delete();   
        session()->flash('success', __('تم الحذف بنجاح'));
        return redirect()->route('cacheir');
    
    }//end of order

}
