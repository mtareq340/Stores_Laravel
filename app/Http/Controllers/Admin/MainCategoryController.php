<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
use App\Models\MainCategory;

class MainCategoryController extends Controller
{
    public function index(){
        $default_language = get_default_lang();
        $maincategories = MainCategory::where('translation_lang', $default_language)->selection()->get();
        return view('admin.maincategories.index',compact('maincategories'));
    }
    public function create(){
        return view('admin.maincategories.create');
    }


    public function store(MainCategoryRequest $request)
    {

        try {

            $main_categories = collect($request->category);

            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_category = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('maincategories', $request->photo);
            }

            DB::beginTransaction();

            $default_category_id = MainCategory::insertGetId([
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath
            ]);

            $categories = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($categories) && $categories->count()) {

                $categories_arr = [];
                foreach ($categories as $category) {
                    $categories_arr[] = [
                        'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath
                    ];
                }

                MainCategory::insert($categories_arr);
            }

            DB::commit();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function edit($mainCat_id)
    {
        $maincategory = MainCategory::find($mainCat_id);
        if(!$maincategory)
        return redirect()->route('admin.maincategories')->with(['error' => 'هذا الحقل غير موجود']);

    }
}
