<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechnicalRequest;
use Illuminate\Http\Request;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use App\Technical;
use App\Store;
use App\Role;
use App\Order;
use DB;

class TechnicalController extends Controller
{
    function fetch_data(Request $request)
    {
        if (! Gate::allows('عرض_العمالة')) {
            return abort(401);
        }
     if($request->ajax())
     {
      if($request->from_date != '' && $request->to_date != '')
      {
        $from_date = \Carbon\Carbon::parse($request->from_date)->format('Y/m/d');
        $to_date = \Carbon\Carbon::parse($request->to_date)->format('Y/m/d');

        $technicals  = Technical::leftJoin('technicals','orders')
        ->groupBy('technicals.id')
        ->orderBy('orders_count','desc')
        ->selectRaw('technicals.*, count(orders.technical_id) as orders_count')
        ->take(5)
        ->get();
        // dd($technicals);
    //    $data =Order::whereDate('created_at', '>=', $from_date)
    //    ->whereDate('created_at', '<=', $to_date)
    //    ->get();
    //    dd($data);


      } 
      else
      {
    //    $data = DB::table('orders')->orderBy('created_at', 'desc')->get();
    $technicals = Technical::all();

      }
      echo json_encode($technicals);
     }
    }

    public function index(){
        if (! Gate::allows('عرض_العمالة')) {
            return abort(401);
        }
            $technicals = Technical::all();
                $technicals = Technical::all();
                $stores = Role::where('title', 'store')->first()->users()->get()->pluck('name','id');
                // $stores = Store::all()->pluck('name','id')->prepend('-- من فضلك اختار --', '');

        return view('admin.technicals.index',compact('technicals','stores'));
    }
    

    public function create(){
        if (! Gate::allows('عرض_العمالة')) {
            return abort(401);
        }
        // $stores = Store::all()->pluck('name','id')->prepend('-- من فضلك اختار --', '');
        $stores = Role::where('title', 'store')->first()->users()->get()->pluck('name','id')->prepend('-- من فضلك اختار --', '');

        return view('admin.technicals.create',compact('stores'));
    }


    public function store(TechnicalRequest $request)
    {
        if (! Gate::allows('عرض_العمالة')) {
            return abort(401);
        }
        Technical::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.technicals')->with(['success' => 'تم الحفظ بنجاح']);


    }

    public function edit($technical_id)
    {
        if (! Gate::allows('عرض_العمالة')) {
            return abort(401);
        }
        $stores = Role::where('title', 'store')->first()->users()->get()->pluck('name','id')->prepend('-- من فضلك اختار --', '');
        
        $technical = Technical::find($technical_id);
        if(!$technical){
             return redirect()->route('admin.technicals')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.technicals.edit',compact('technical','stores'));

    }

    public function update($id ,TechnicalRequest $request){
        if (! Gate::allows('عرض_العمالة')) {
            return abort(401);
        }
        try{
            $technical = Technical::find($id);
            if(!$technical){
                return redirect()->route('admin.technicals.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
     
            $technical -> update($request->except('_token'));
            return redirect()->route('admin.technicals')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.technicals')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_العمالة')) {
            return abort(401);
        }
        try{
            $technical = Technical::find($id);
            if(!$technical){
                return redirect()->route('admin.technicals.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $technical ->delete();
            return redirect()->route('admin.technicals')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.technicals')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
        // return view('admin.languages.edit',compact('language'));
    }
}
