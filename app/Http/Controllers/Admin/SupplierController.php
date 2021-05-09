<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SupplierRequest;
use App\Supplier;
use App\Supplierorder;
class SupplierController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_الموردين')) {
            return abort(401);
        }
        $suppliers = Supplier::paginate(6);
        // $stores = Role::where('title', 'store')->first()->users()->get()->pluck('name','id')->prepend('-- من فضلك اختار --', '');

        return view('admin.suppliers.index',compact('suppliers'));
    }

    public function orders($supplier_id){    
     
        $supplierorders = Supplierorder::where('supplier_id', $supplier_id)->get();
 
        return view('admin.suppliers.orders',compact('supplierorders'));
    }


    public function create(){
        if (! Gate::allows('عرض_الموردين')) {
            return abort(401);
        }
        return view('admin.suppliers.create');
    }


    public function store(SupplierRequest $request)
    {
        if (! Gate::allows('عرض_الموردين')) {
            return abort(401);
        }

        Supplier::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.suppliers')->with(['success' => 'تم الحفظ بنجاح']);

    }
    public function edit($supplier_id)
    {
        if (! Gate::allows('عرض_الموردين')) {
            return abort(401);
        }
        $supplier = Supplier::find($supplier_id);
        if(!$supplier){
             return redirect()->route('admin.suppliers')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.suppliers.edit',compact('supplier'));

    }
    public function update($id ,SupplierRequest $request){
        if (! Gate::allows('عرض_الموردين')) {
            return abort(401);
        }
        try{
            $supplier = Supplier::find($id);
            if(!$supplier){
                return redirect()->route('admin.suppliers.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
     
            $supplier -> update($request->except('_token'));
            return redirect()->route('admin.suppliers')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.suppliers')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
       
    }
    public function destroy($id){
        if (! Gate::allows('عرض_الموردين')) {
            return abort(401);
        }
        try{
            $supplier = Supplier::find($id);
            if(!$supplier){
                return redirect()->route('admin.suppliers.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $supplier ->delete();
            return redirect()->route('admin.suppliers')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.suppliers')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
