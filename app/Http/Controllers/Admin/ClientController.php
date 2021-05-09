<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
use App\Client;
use App\Technical;
use App\Store;
use App\Role;

class ClientController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_العملاء')) {
            return abort(401);
        }
        $clients = Client::paginate(6);
        $stores = Role::where('title', 'store')->first()->users()->get()->pluck('name','id')->prepend('-- من فضلك اختار --', '');

        $technicals = Technical::all()->pluck('name', 'id');

        return view('admin.clients.index',compact('clients','technicals','stores'));
    }

    public function create(){
        if (! Gate::allows('عرض_العملاء')) {
            return abort(401);
        }
        $stores = Role::where('title', 'user')->first()->users()->get()->pluck('name','id')->prepend('-- من فضلك اختار --', '');
        $technicals = Technical::all()->pluck('name', 'id');

        return view('admin.clients.create',compact('stores','technicals'));
    }


    public function store(Request $request)
    {

        if (! Gate::allows('عرض_العملاء')) {
            return abort(401);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'store_id' => 'required',
            'technical_id' => 'required',
        ]);
  
       


        Client::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.clients')->with(['success' => 'تم الحفظ بنجاح']);


    }

    public function edit($client_id)
    {
        if (! Gate::allows('عرض_العملاء')) {
            return abort(401);
        }
        $stores = Role::where('title', 'user')->first()->users()->get()->pluck('name','id')->prepend('-- من فضلك اختار --', '');
        $technicals = Technical::all()->pluck('name', 'id');

        $client = Client::find($client_id);
        if(!$client){
             return redirect()->route('admin.clients')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.clients.edit',compact('client','stores','technicals'));

    }

    public function update($id ,Request $request){
        if (! Gate::allows('عرض_العملاء')) {
            return abort(401);
        }
        try{
            $client = Client::find($id);
            if(!$client){
                return redirect()->route('admin.clients.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
     
            $client -> update($request->except('_token'));
            return redirect()->route('admin.clients')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_العملاء')) {
            return abort(401);
        }
        try{
            $client = Client::find($id);
            if(!$client){
                return redirect()->route('admin.clients.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $client ->delete();
            return redirect()->route('admin.clients')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.clients')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
        // return view('admin.languages.edit',compact('language'));
    }
}
