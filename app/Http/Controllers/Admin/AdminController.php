<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class AdminController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }

         $admins = User::where('admin', 1)->get();
        // $admins = Role::whereNotIn('title', ['store','cacheir'])->all()->users()->get();
        return view('admin.admins.index',compact('admins'));
    }

    public function create(){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        // $roles = Role::get()->pluck('title', 'id');
        $roles = Role::whereNotIn('title', ['store','cacheir'])->get()->pluck('title','id')->prepend('-- من فضلك اختار --', '');

        return view('admin.admins.create',compact('roles'));
    }


    public function store(UserRequest $request)
    {
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
            try{
                $admin = new User();
                $admin->name = $request->name;
                $admin->email = $request->email;
                $admin->admin = 1;
                $admin->password = Hash::make($request->password);
                $admin->save();
                
                $role = Role::find($request->role_id);
                $admin->roles()->sync($role);

                session()->flash('success', __('site.added_successfully'));
                return redirect()->route('admin.admins')->with(['success' => 'تم الحفظ بنجاح']);

            }catch(\Exception $ex){
                return redirect()->route('admin.admins')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
            }


    }

    public function edit($admin_id)
    {
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        $roles = Role::whereNotIn('title', ['store','cacheir'])->get()->pluck('title','id');
        $admin = User::findOrFail($admin_id);
        if(!$admin_id){
             return redirect()->route('admin.admins')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.admins.edit',compact('admin','roles'));

    }

    public function update($id ,UpdateUserRequest $request){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }

        try{
            $admin = User::findOrFail($id);

            if(!$admin){
                return redirect()->route('admin.stores.edit',$id)->with(['error' => 'هذه المستخدم غير موجودة']);
            }
        //update in db
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->update();
            return redirect()->route('admin.admins')->with(['success' => 'تم تحديث المستخدم بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.admins')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }

        try{
            $admin = User::find($id);
            if(!$admin){
                return redirect()->route('admin.admins.edit',$id)->with(['error' => 'هذه المستخدم غير موجودة']);
            }
        //update in db
            $admin ->delete();
            return redirect()->route('admin.admins')->with(['success' => 'تم حذف المستخدم بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.admins')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

}
