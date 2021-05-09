<?php

namespace App\Http\Controllers\Cacheir;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Order;
use App\Mainproduct;
use App\Product;
use App\User;
class ProductPriceController extends Controller
{
    public function index(Request $request){
     
        $store = User::FindOrFail(Auth::user()->store_id);

        $products = $store->productsprice()->get();
        return view('cacheir/productsprice/index', compact('products'));
    }

    public function edit()
    {
   
        $store = User::findOrFail(Auth::user()->store_id);
        // dd($store->productsprice()->get());
        $products = $store->productsprice()->get();
        return view('cacheir.productsprice.edit',compact('products'));

    }

    public function update(Request $request){
        // dd($request->products);

        try{

            $store = User::FindOrFail(Auth::user()->store_id);
            if(!$store){
                return redirect()->route('admin.countries.edit',$id)->with(['error' => 'هذه المنطقة غير موجودة']);
            }
        //update in db
     
            $store ->productsprice()->sync($request->products);
            return redirect()->route('cacheir.productsprice.index')->with(['success' => 'تم تحديث السعر بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('cacheir.productsprice.index')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

 
   
}
