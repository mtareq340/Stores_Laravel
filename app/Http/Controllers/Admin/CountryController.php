<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
use App\Country;
use App\Product;
use App\Category;
use App\Store;

class CountryController extends Controller
{
    public function index(){
        // if (! Gate::allows('عرض_المناطق')) {
        //     return abort(401);
        // }
        $countries = Country::all();

        return view('admin.countries.index',compact('countries'));
    }

    public function create(){

        $products = Product::all()->where('price_value', 0);
        return view('admin.countries.create',compact('products'));
    }


    public function store(CountryRequest $request)
    {
        // if (! Gate::allows('عرض_المناطق')) {
        //     return abort(401);
        // }
        // dd($request);
        $country = Country::create($request->all());
        $country->products()->attach($request->products);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.countries')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($country_id)
    {
        if (! Gate::allows('عرض_المناطق')) {
            return abort(401);
        }
        $countryProducts = Country::where('id', $country_id)->first()->products()
        ->where('price_value', 0)->get();

        $country = Country::find($country_id);

        if(!$country){
             return redirect()->route('admin.countries')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.countries.edit',compact('country','countryProducts'));

    }

    public function update($id ,CountryRequest $request){
        // dd($request->products);
        if (! Gate::allows('عرض_المناطق')) {
            return abort(401);
        }

        try{

            $country = Country::find($id);
            if(!$country){
                return redirect()->route('admin.countries.edit',$id)->with(['error' => 'هذه المنطقة غير موجودة']);
            }
        //update in db
     
            $country -> update($request->except('_token'));
            $country ->products()->sync($request->products);
            return redirect()->route('admin.countries')->with(['success' => 'تم تحديث المنطقة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.countries')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_المناطق')) {
            return abort(401);
        }
        try{
            $country = Country::find($id);
            if(!$country){
                return redirect()->route('admin.countries.edit',$id)->with(['error' => 'هذه المنطقة غير موجودة']);
            }
        //update in db
            $country ->delete();
            return redirect()->route('admin.countries')->with(['success' => 'تم حذف المنطقة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.countries')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
