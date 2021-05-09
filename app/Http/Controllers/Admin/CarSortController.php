<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarSortRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Carsort;
class CarSortController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }
        $carsorts = Carsort::all();

        return view('admin.carsorts.index',compact('carsorts'));
    }

    public function create(){
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }

        return view('admin.carsorts.create');
    }


    public function store(CarSortRequest $request)
    {
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }

     
        Carsort::create($request->all());

        session()->flash('success', __('تمت اضافة السيارة بنجاح'));
        return redirect()->route('admin.carsorts')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($carsort_id)
    {
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }
        $carsort = Carsort::find($carsort_id);
        if(!$carsort_id){
             return redirect()->route('admin.carsorts')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.carsorts.edit',compact('carsort'));

    }

    public function update($id ,CarSortRequest $request){
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }
        try{
            $carsort = Carsort::find($id);
            if(!$carsort){
                return redirect()->route('admin.carsorts.edit',$id)->with(['error' => 'هذه السيارة غير موجودة']);
            }
        //update in db
     
            $carsort -> update($request->except('_token'));
            return redirect()->route('admin.carsorts')->with(['success' => 'تم تحديث السيارة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.carsorts')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }
        try{
            $carsort = Carsort::find($id);
            if(!$carsort){
                return redirect()->route('admin.carsorts.edit',$id)->with(['error' => 'هذه السيارة غير موجودة']);
            }
        //update in db
            $carsort ->delete();
            return redirect()->route('admin.carsorts')->with(['success' => 'تم حذف السياؤة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.carsorts')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
