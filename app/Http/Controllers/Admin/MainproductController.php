<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MainproductRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
use App\Product;
use App\Mainproduct;
use App\Role;
use App\Category;

class MainproductController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_المخزن')) {
            return abort(401);
        }
        
        $mainproducts = Mainproduct::all();
        // dd($mainproducts);
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.mainproducts.index',compact('mainproducts','categories'));
    }

    public function create(){
        if (! Gate::allows('عرض_المخزن')) {
            return abort(401);
        }
        $categories = Category::all()->pluck('name', 'id')->prepend('-- من فضلك اختار --', '');;

        return view('admin.mainproducts.create',compact('categories'));
    }


    public function store(MainproductRequest $request)
    {
        if (! Gate::allows('عرض_المخزن')) {
            return abort(401);
        }
        $stores = Role::where('title', 'store')->first()->users()->get();
        $mainproduct = Mainproduct::create($request->all());

            foreach($stores as $store){
                $store->mainproducts()->attach($mainproduct);
            }
        
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.mainproducts')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($mainproduct_id)
    {
        if (! Gate::allows('عرض_المخزن')) {
            return abort(401);
        }
        $mainproduct = Mainproduct::find($mainproduct_id);
        $categories = Category::all()->pluck('name', 'id')->prepend('-- من فضلك اختار --', '');;
        if(!$mainproduct){
             return redirect()->route('admin.mainproducts')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.mainproducts.edit',compact('mainproduct','categories'));

    }

    public function update($id ,MainproductRequest $request){
        if (! Gate::allows('عرض_المخزن')) {
            return abort(401);
        }
        try{
            $mainproduct = Mainproduct::find($id);
            if(!$mainproduct){
                return redirect()->route('admin.mainproducts.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
     
            $mainproduct -> update($request->except('_token'));
            return redirect()->route('admin.mainproducts')->with(['success' => 'تم تحديث الخدمة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.mainproducts')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_المخزن')) {
            return abort(401);
        }
        try{
            $mainproduct = Mainproduct::find($id);
            if(!$mainproduct){
                return redirect()->route('admin.mainproducts.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
            
            $product = Product::FindOrFail($id);
            $product->delete();
            $mainproduct ->delete();
            return redirect()->route('admin.mainproducts')->with(['success' => 'تم حذف الخدمة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.mainproducts')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
