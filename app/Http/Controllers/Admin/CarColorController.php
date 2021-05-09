<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarColorRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Carcolor;
class CarColorController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }
        $carcolors = Carcolor::all();

        return view('admin.carcolors.index',compact('carcolors'));
    }

    public function create(){
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }

        return view('admin.carcolors.create');
    }


    public function store(CarColorRequest $request)
    {
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }

     
        Carcolor::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.carcolors')->with(['success' => 'تم الحفظ بنجاح']);


    }

    public function edit($carcolor_id)
    {
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }
        $carcolor = Carcolor::find($carcolor_id);
        if(!$carcolor){
             return redirect()->route('admin.carcolors')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.carcolors.edit',compact('carcolor'));

    }

    public function update($id ,CarColorRequest $request){
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }
        try{
            $carcolor = Carcolor::find($id);
            if(!$carcolor){
                return redirect()->route('admin.carcolorss.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
     
            $carcolor -> update($request->except('_token'));
            return redirect()->route('admin.carcolors')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.carcolors')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_الوان_السيارات')) {
            return abort(401);
        }
        try{
            $carcolor = Carcolor::find($id);
            if(!$carcolor){
                return redirect()->route('admin.carcolors.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $carcolor ->delete();
            return redirect()->route('admin.carcolors')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.carcolors')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
