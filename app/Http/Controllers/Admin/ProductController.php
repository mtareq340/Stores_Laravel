<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
use App\Product;
use App\Mainproduct;
use App\Role;
use App\User;
use App\Country;
use App\Category;

class ProductController extends Controller
{
    
    public function index(){
        if (! Gate::allows('عرض_الخدمات')) {
            return abort(401);
        }

        $products = Product::all();
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.products.index',compact('products','categories'));
    }

    public function create(){
        if (! Gate::allows('عرض_الخدمات')) {
            return abort(401);
        }
        $categories = Category::all()->pluck('name', 'id')->prepend('-- من فضلك اختار --', '');
        $price_values = array('السعر تابع للفرع ', 'السعر ثابت تابع للمنطقة');
        $countables = array('يوجد مخزن للخدمة', 'لا يوجد مخزن للخدمة');
        return view('admin.products.create',compact('categories', 'price_values', 'countables'));
    }


    public function store(ProductRequest $request)
    {
        if (! Gate::allows('عرض_الخدمات')) {
            return abort(401);
        }

        $stores = Role::where('title', 'store')->first()->users()->get();
        $countries = Country::all();
        $product = Product::create($request->all());

        if($product->countable == 1){
            $mainproduct = new Mainproduct();
            $mainproduct->id = $product->id;
            $mainproduct->name = $product->name;
            $mainproduct->category_id = $product->category_id;
            $mainproduct->save();
            $main = Mainproduct::FindOrFail($product->id);
            foreach($stores as $store){
                $store->mainproducts()->attach($main);
            }
        }else {}
       

        if($product->price_value == 0)
        {
            foreach($countries as $country){
                $country->products()->attach($product);
            }
        }
        elseif($product->price_value == 1)
        {
            foreach($stores as $store){
                $store->productsprice()->attach($product);
            }
         
        }
        else{

        }

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.products')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($product_id)
    {
        if (! Gate::allows('عرض_الخدمات')) {
            return abort(401);
        }
        $product = product::find($product_id);
        $categories = Category::all()->pluck('name', 'id');
        if(!$product){
             return redirect()->route('admin.products')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.products.edit',compact('product','categories'));

    }

    public function update($id ,ProductRequest $request){
        if (! Gate::allows('عرض_الخدمات')) {
            return abort(401);
        }
        try{
            $product = Product::find($id);
            if(!$product){
                return redirect()->route('admin.products.edit',$id)->with(['error' => 'هذه المنتج غير موجودة']);
            }
        //update in db
     
            $product -> update($request->except('_token'));
            return redirect()->route('admin.products')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
       
    }

    public function destroy($id){

        if (! Gate::allows('عرض_الخدمات')) {
            return abort(401);
        }
        try{
            $product = Product::find($id);
            if(!$product){
                return redirect()->route('admin.products.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            if($product->countable)
            {

                $mainproduct = Mainproduct::FindOrFail($product->id);
                $mainproduct->delete();
            }
            $product ->delete();
            return redirect()->route('admin.products')->with(['success' => 'تم حذف الخدمة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
