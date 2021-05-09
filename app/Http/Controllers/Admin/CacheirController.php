<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\CacheirRequest;
use App\Http\Requests\UpdateCacheirRequest;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;
use App\Technical;
use App\Store;
use App\Role;
use App\Country;
use App\Shift;
use App\User;

class CacheirController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_مديرين_الفروع')) {
            return abort(401);
        }


        $cacheirs = Role::where('title', 'cacheir')->first()->users()->get();

        return view('admin.cacheirs.index',compact('cacheirs'));
    }

    public function create(){
        if (! Gate::allows('عرض_مديرين_الفروع')) {
            return abort(401);
        }

        $stores = Role::where('title', 'store')->first()->users()->get()->pluck('name','id')->prepend('-- من فضلك اختار --', '');

        return view('admin.cacheirs.create',compact('stores'));
    }


    public function store(CacheirRequest $request)
    {
        if (! Gate::allows('عرض_مديرين_الفروع')) {
            return abort(401);
        }
            try{
                // $hashpassword = Hash::make($request->password);
                $cacheir = new User();
                $cacheir->name = $request->name;
                $cacheir->email = $request->email;
                $cacheir->store_id = $request->store_id;
                $cacheir->country_id = $request->country_id;
                $cacheir->password = Hash::make($request->password);
                $cacheir->save();
                
                $role = Role::find(2);
                $cacheir->roles()->sync($role);

                $shift = new Shift();
                $shift->cacheir_id = $cacheir->id;
                $shift->store_id = $cacheir->store_id;
                $shift->start = 0;
                $shift->save();

                session()->flash('success', __('site.added_successfully'));
                return redirect()->route('admin.cacheirs')->with(['success' => 'تم الحفظ بنجاح']);

            }catch(\Exception $ex){
                return redirect()->route('admin.cacheirs')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
            }


    }

    public function edit($cacheir_id)
    {
        if (! Gate::allows('عرض_مديرين_الفروع')) {
            return abort(401);
        }
        $cacheir = User::findOrFail($cacheir_id);
        $stores = Role::where('title', 'store')->first()->users()->get()->pluck('name','id');
     
        if(!$cacheir){
             return redirect()->route('admin.cacheirs')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.cacheirs.edit',compact('cacheir','stores'));

    }

    public function update($id ,UpdateCacheirRequest $request){
        if (! Gate::allows('عرض_مديرين_الفروع')) {
            return abort(401);
        }
        try{
            $cacheir = User::findOrFail($id);
            if(!$cacheir){
                return redirect()->route('admin.cacheirs.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $cacheir->name = $request->name;
            $cacheir->email = $request->email;
            $cacheir->store_id = $request->store_id;
            $cacheir -> update();
            return redirect()->route('admin.cacheirs')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.cacheirs')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_مديرين_الفروع')) {
            return abort(401);
        }
        try{
            $cacheir = User::find($id);
            if(!$cacheir){
                return redirect()->route('admin.cacheirs.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $cacheir ->delete();
            return redirect()->route('admin.cacheirs')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.cacheirs')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
