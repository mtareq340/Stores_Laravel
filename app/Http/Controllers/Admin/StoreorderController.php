<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierOrderRequest;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Storeorder;
use App\Mainproduct;
class StoreorderController extends Controller 
{
    public function index(){    
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
        
        $storeorders = Storeorder::all();
 
        return view('admin.storeorders.index',compact('storeorders'));
    }
    public function create($store_id)
    {
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
        $store = User::findOrfail($store_id);
        $mainproducts = Mainproduct::all();
        return view('admin.storeorders.create', compact( 'store','mainproducts'));

    }//end of create

    public function store(SupplierOrderRequest $request)
    {
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
        $store = User::FindOrFail($request->store_id);
    //     $store->main
       
        foreach ($request->mainproducts as $id => $quantity) {
            $item = $store->mainproducts()->where('mainproduct_id', $id)->first();
            if($item->quantity >= $quantity['quantity']){

                }
                else{
                    return redirect()->back()->with('error',  ' لا توجد كمية كافية في المخزن!');
                }
        
        }//end of foreach
       
        foreach ($request->mainproducts as $id => $quantity) {
            $item = $store->mainproducts()->where('mainproduct_id', $id)->first();
            //store stock
           
            //main stock
            if($item->quantity >= $quantity['quantity']){

                $item->quantity = $item->quantity -  $quantity['quantity'];
                $item->save();
                $item->pivot->quantity = $item->pivot->quantity +  $quantity['quantity'];
                $item->pivot->save();

                }
                else{
                    return redirect()->back()->with('error', 'لا توجد كمية كافية في المخزن!');
                }
          
        }//end of foreach

        $storeorder = Storeorder::create($request->all());
        $storeorder->mainproducts()->attach($request->mainproducts);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.stores')->with(['success' => 'تم الحفظ بنجاح']);

    }//end of store

    public function update(Request $request){
        if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }

        $storeorder = Storeorder::findOrFail($request->id);

    //update in db
        $storeorder->remaining_price = $request->remaining_price - $request->add_price;
        $storeorder->paid_price = $storeorder->total_price - $storeorder->remaining_price;
        $storeorder -> update();

     
        return response()->json($storeorder);  
 
   
}

    public function destroy($storeorder_id)
    {
          if (! Gate::allows('عرض_الفروع')) {
            return abort(401);
        }
        try{
            $storeorder = Storeorder::FindOrFail($storeorder_id);
            $store = User::FindOrFail($storeorder->store_id);
            if(!$storeorder){
                return redirect()->route('admin.supplierorders.edit',$id)->with(['error' => 'هذا الفرع غير موجد']);
            }
        //update in db
            foreach ($storeorder->mainproducts as $mainproduct) {
            $item = $store->mainproducts()->where('mainproduct_id', $mainproduct->id)->first();
            $item->pivot->quantity = $item->pivot->quantity -  $mainproduct->pivot->quantity;
            $item->pivot->save();
            
            $mainproduct->update([
                'quantity' => $mainproduct->quantity + $mainproduct->pivot->quantity
            ]);
            }//end of foreach

            $storeorder ->delete();
            return redirect()->route('admin.stores')->with(['success' => 'تم حذف الطلب بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.stores')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       

    }//end of detach order
}
