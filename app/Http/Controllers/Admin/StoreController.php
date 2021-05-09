<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;
use App\Technical;
use App\Store;
use App\Role;
use App\Country;
use App\Mainproduct;
use App\Product;
use App\Storeorder;
use App\User;

class StoreController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
        // $teachers = Role::where('title', 'Teacher')->first()->users()->get();

        $stores = Role::where('title', 'store')->first()->users()->get();

        return view('admin.stores.index',compact('stores'));
    }
    public function stock($store_id){
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }

        $store = User::FindOrFail($store_id);
        $mainproducts = $store->mainproducts()->get();

        return view('admin.stores.stock',compact('mainproducts','store'));
    }
    public function orders($store_id){    
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
     
        $storeorders = Storeorder::where('store_id', $store_id)->get();
 
        return view('admin.stores.orders',compact('storeorders'));
    }

    public function create(){
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
        
        $countries = Country::all()->pluck('name','id')->prepend('-- من فضلك اختار --', '');
        return view('admin.stores.create', compact('countries'));
    }


    public function store(StoreRequest $request)
    {
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }

                $products = Product::where('price_value', 1)->get();
                $mainproducts = Mainproduct::all();

                $store = new User();
                $store->name = $request->name;
                $store->country_id = $request->country_id;
                $store->email = $request->email;
                $store->password = Hash::make($request->password);
                $store->save();
                $store->mainproducts()->attach($mainproducts);
                $store->productsprice()->attach($products);
                // $user = User::create($request->except(['_token']));
                $role = Role::find(3);
                $store->roles()->sync($role);
                session()->flash('success', __('site.added_successfully'));
                return redirect()->route('admin.stores')->with(['success' => 'تم الحفظ بنجاح']);

            


    }

    public function edit($store_id)
    {
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
   
        $countries = Country::all()->pluck('name','id');
        $store = User::findOrFail($store_id);
        if(!$store){
             return redirect()->route('admin.stores')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.stores.edit',compact('store','countries'));

    }

    public function update($id ,UpdateStoreRequest $request){
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }

        try{
            $store = User::findOrFail($id);

            if(!$store){
                return redirect()->route('admin.stores.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $store->name = $request->name;
            $store->email = $request->email;
            $store->country_id = $request->country_id;
            $store -> update();
            return redirect()->route('admin.stores')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.stores')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function supply($store_id)
    {
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
   
        $products = Product::all();
        $store = User::findOrFail($store_id);
        if(!$store){
             return redirect()->route('admin.stores')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.stores.supply',compact('store','products'));

    }

    public function destroy($id){
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
        
        try{
            $store = User::find($id);
            if(!$store){
                return redirect()->route('admin.stores.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $store ->delete();
            return redirect()->route('admin.stores')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.stores')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
        // return view('admin.languages.edit',compact('language'));
    }
}
