<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        // if (! Gate::allows('عرض_المستخدمين')) {
        //     return abort(401);
        // }


                $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }

        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }

     
        Permission::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.permissions')->with(['success' => 'تم الحفظ بنجاح']);


    }
    public function edit($permission_id)
    {
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        $permission = Permission::find($permission_id);
        if(!$permission){
             return redirect()->route('admin.permissions')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.permissions.edit',compact('permission'));

    }
    public function update($id ,Request $request){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        try{
            $permission = Permission::find($id);
            if(!$permission){
                return redirect()->route('admin.permissions.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
     
            $permission -> update($request->except('_token'));
            return redirect()->route('admin.permissions')->with(['success' => 'تم تحديث الصلاحية بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.permissions')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_المستخدمين')) {
            return abort(401);
        }
        try{
            $permission = Permission::find($id);
            if(!$permission){
                return redirect()->route('admin.permissions.edit',$id)->with(['error' => 'هذه الصلاحية غير موجودة']);
            }
        //update in db
            $permission ->delete();
            return redirect()->route('admin.permissions')->with(['success' => 'تم حذف الصلاحية بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.permissions')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

}
