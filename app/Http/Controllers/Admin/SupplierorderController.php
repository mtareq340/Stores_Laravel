<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierOrderRequest;
use Illuminate\Support\Facades\Gate;
use App\Supplierorder;
use App\Mainproduct;
use App\Supplier;
class SupplierorderController extends Controller
{
    public function index(){    
        if (! Gate::allows('عرض_طلبات_الموردين')) {
            return abort(401);
        }
        
        $supplierorders = Supplierorder::all();
 
        return view('admin.supplierorders.index',compact('supplierorders'));
    }
    public function create($supplier_id)
    {
        if (! Gate::allows('عرض_طلبات_الموردين')) {
            return abort(401);
        }
        $supplier = Supplier::findOrfail($supplier_id);
        $mainproducts = Mainproduct::all();
        return view('admin.supplierorders.create', compact( 'supplier','mainproducts'));

    }//end of create

    public function store(SupplierOrderRequest $request)
    {
        if (! Gate::allows('عرض_طلبات_الموردين')) {
            return abort(401);
        }

        // dd($request->mainproducts);
        $supplierorder = Supplierorder::create($request->all());
        $supplierorder->mainproducts()->attach($request->mainproducts);
       
        foreach ($request->mainproducts as $id => $quantity) {
            $mainproduct = Mainproduct::FindOrFail($id);

            $mainproduct->update([
                'quantity' => $mainproduct->quantity + $quantity['quantity'],
            ]);

          

        }//end of foreach

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.suppliers')->with(['success' => 'تم الحفظ بنجاح']);

    }//end of store

    public function update( Request $request){
        if (! Gate::allows('عرض_طلبات_الموردين')) {
            return abort(401);
        }
            $supplierorder = Supplierorder::findOrFail($request->id);

        //update in db
            $supplierorder->remaining_price = $request->remaining_price - $request->add_price;
            $supplierorder->paid_price = $supplierorder->total_price - $supplierorder->remaining_price;
            $supplierorder -> update();

         
            return response()->json($supplierorder);  
     
       
    }

    public function destroy($supplierorder_id)
    {
        if (! Gate::allows('عرض_طلبات_الموردين')) {
            return abort(401);
        }
        try{
            $supplierorder = Supplierorder::FindOrFail($supplierorder_id);
            if(!$supplierorder){
                return redirect()->route('admin.supplierorders.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            foreach ($supplierorder->mainproducts as $mainproduct) {
            $mainproduct->update([
                'quantity' => $mainproduct->quantity - $mainproduct->pivot->quantity
            ]);
            }//end of foreach
            $supplierorder ->delete();
            return redirect()->route('admin.supplierorders')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.supplierorders')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       

    }//end of detach order

}
