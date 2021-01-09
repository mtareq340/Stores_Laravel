<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;

class LanguagesController extends Controller
{
    public function index(){
        $languages = Language::select()->paginate(PAGINATION_COUNT);
        return view('admin.languages.index',compact('languages'));
    }
    public function create(){
        return view('admin.languages.create');
    }

    public function store(LanguageRequest $request){

        if(!$request->has('active'))
            $request->request->add(['active' => 0]);
            
        try{
            
            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);
        }
    }
    public function edit($id){
        $language = Language::select()->find($id);
        if(!$language){
            return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة']);
        }
        return view('admin.languages.edit',compact('language'));
    }

    public function update($id,LanguageRequest $request){
        try{
            $language = Language::find($id);
            if(!$language){
                return redirect()->route('admin.languages.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
        if(!$request->has('active'))
            $request->request->add(['active' => 0]);
            $language -> update($request->except('_token'));
            return redirect()->route('admin.languages')->with(['success' => 'تم تحديث اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
    }

    public function destroy($id){
        try{
            $language = Language::find($id);
            if(!$language){
                return redirect()->route('admin.languages.edit',$id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
        //update in db
            $language ->delete();
            return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);

        }catch(\Exception $ex){
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ برجاء المحاولة ثانيا']);

        }
       
        // return view('admin.languages.edit',compact('language'));
    }
}
