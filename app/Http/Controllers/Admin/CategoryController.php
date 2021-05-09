<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
use App\Category;
use App\Store;

class CategoryController extends Controller
{
    public function index(){
        if (! Gate::allows('عرض_الاقسام')) {
            return abort(401);
        }
        $categories = Category::all();

        return view('admin.categories.index',compact('categories'));
    }

    public function create(){
        if (! Gate::allows('عرض_الاقسام')) {
            return abort(401);
        }
        return view('admin.categories.create');
    }


    public function store(CategoryRequest $request)
    {
        if (! Gate::allows('عرض_الاقسام')) {
            return abort(401);
        }
     
        Category::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.categories')->with(['success' => 'تم الحفظ بنجاح']);


    }

    public function edit($category_id)
    {
        if (! Gate::allows('عرض_الاقسام')) {
            return abort(401);
        }
        $category = Category::find($category_id);
        if(!$category_id){
             return redirect()->route('admin.categories')->with(['error' => 'هذا الحقل غير موجود']);
         }
        return view('admin.categories.edit',compact('category'));

    }

    public function update($id ,CategoryRequest $request){
        if (! Gate::allows('عرض_الاقسام')) {
            return abort(401);
        }
        try{
            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.categories.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
     
            $category -> update($request->except('_token'));
            return redirect()->route('admin.categories')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.categories')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        if (! Gate::allows('عرض_الاقسام')) {
            return abort(401);
        }
        try{
            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.categories.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $category ->delete();
            return redirect()->route('admin.categories')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.categories')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }
}
