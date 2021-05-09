<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Product;
use App\User;
use App\Order;
use App\Country;
use App\Http\Requests\StoreOrderRequest;
use Auth;

class OrderController extends Controller
{
    public function getData(Request $request){
        // get records from database
        $data = $request->all();
        $category_id = $data['category_id'];
        $category = Category::with('products')->findOrFail( $category_id );
        // $category = Category::find($id);
        $response = $category;
        return response()->json(json_encode($response));
        // return response()->json(['data'=> $data]);

      }
    
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact( 'client', 'categories', 'orders'));

    }//end of create

    public function store(StoreOrderRequest $request)
    {
     
        $country = Country::FindOrFail(Auth::user()->country_id);
        // dd($country);
        $request->request->add(['store_id' => Auth::user()->id ]);
        $store = User::FindOrFail(Auth::user()->id);

        foreach($request->products as $id => $quantity)
        {
            $product = Product::FindOrFail($id);
            if($product->countable)
            {
                $item = $store->mainproducts()->where('mainproduct_id', $product->id)->first();
                if($quantity['quantity'] > $item->pivot->quantity)
                {
                    return redirect()->back()->with('error', 'لا توجد كمية كافية في المخزن!',);
                }
                else{
                    $item->pivot->quantity -= $quantity['quantity'];
                    $item->pivot->save();
                }
              
            }
        }
        
        $order = Order::create($request->except(['products']));
        $order->products()->attach($request->products);
  
        $total_price = 0;

        foreach ($request->products as $id => $quantity) {
            $product = Product::FindOrFail($id);
            $itemorder = $order->products()->where('product_id', $id)->first();
            if($product->price_value == 0)
            {
                $item = $country->products()->where('product_id', $id)->first();

               $itemorder->pivot->price = $item->pivot->price ;
               $itemorder->pivot->save();
            }
            elseif($product->price_value == 1)
            {
              
                $item = $store->products()->where('product_id', $id)->first();

                $itemorder->pivot->price = $item->pivot->price ;
                $itemorder->pivot->save();
             
            }
            else{ }

            $total_price += $itemorder->pivot->price * $quantity['quantity'];
          
        }//end of foreach

        $order->update([
            'total_price' => $total_price,
            'technical_id' => $request->technical_id,
            'store_id' => $store->id
        ]);


        session()->flash('success', __('site.added_successfully'));

        return view('admin.orders.print',compact('order'));


    }//end of store

    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit', compact('client', 'order', 'categories', 'orders'));

    }//end of edit

    public function update(Request $request, Client $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);

        $this->attach_order($request, $client);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');

    }//end of update

    private function attach_order($request, $client)
    {
        //  dd($request->all());

        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::FindOrFail($id);
            $total_price += $product->price * $quantity['quantity'];

            // $product->update([
            //     'stock' => $product->stock - $quantity['quantity']
            // ]);

        }//end of foreach

        $order->update([
            'total_price' => $total_price
        ]);

    }//end of attach order

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

            // $product->update([
            //     'stock' => $product->stock + $product->pivot->quantity
            // ]);

        }//end of for each

        $order->delete();

    }//end of detach order
}
