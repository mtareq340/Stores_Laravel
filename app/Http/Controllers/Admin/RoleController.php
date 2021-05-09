<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    public function index()
    {
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }


                $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {

        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        $role = Role::create($request->all());
        $role->permission()->sync(array_filter((array)$request->permission_id));
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.roles')->with(['success' => 'تم الحفظ بنجاح']);


    }
    public function edit($role_id)
    {
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        $permissions = Permission::get();
        $role = Role::findOrFail($role_id);

        if(!$role){
             return redirect()->route('admin.roles')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.roles.edit',compact('role','permissions'));

    }
    public function update($id ,Request $request){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        try{
            $role = Role::find($id);
            if(!$role){
                return redirect()->route('admin.roles.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
     
            $role -> update($request->except('_token'));
            $role->permission()->sync(array_filter((array)$request->permission_id));
            return redirect()->route('admin.roles')->with(['success' => 'تم تحديث الصلاحية بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.roles')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        try{
            $role = Role::find($id);
            if(!$role){
                return redirect()->route('admin.roles.edit',$id)->with(['error' => 'هذه الصلاحية غير موجودة']);
            }
        //update in db
            $role ->delete();
            return redirect()->route('admin.roles')->with(['success' => 'تم حذف الصلاحية بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.roles')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
