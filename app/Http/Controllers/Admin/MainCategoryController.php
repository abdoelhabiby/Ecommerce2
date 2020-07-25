<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\MainCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\TryCatch;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_categories = MainCategory::where("translation_lang",languageLocal())->selection()->paginate(PAGINATE_COUNT);

        return view("admin.main_categories.index",compact("main_categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.main_categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {
        $path = null;

        if($request->photo){
          $photo = $request->file("photo");
          $path = imageUpload($photo,"main_categories");

        }

        $all_categories = collect($request->category);

        // filter to get default language

        $filter = $all_categories->filter(function($value,$key){
            return $value["translation_lang"] == languageLocal();
        });

         $default_category_array = ($filter->toArray())[0];






        try {
            DB::beginTransaction();

             $main_cateory_id = MainCategory::insertGetId([
                "name" => $default_category_array['name'],
                "slug" => $default_category_array['name'],
                "translation_lang" => $default_category_array['translation_lang'],
                "translation_of" => 0,
                "photo" => $path,
                "active" => $default_category_array['active'],
             ]);


            // filter to get all without default language

            $main_categories = $all_categories->filter(function ($value, $key) {
                return $value["translation_lang"] != languageLocal();
            });


             if($main_categories && $main_categories->count() > 0){

                $set_main_categories = [];

                foreach ($main_categories as  $main_category) {
                     $set_main_categories[] = [
                         'translation_lang' => $main_category['translation_lang'],
                         'translation_of' => $main_cateory_id,
                         'name' => $main_category['name'],
                         'slug' => $main_category['name'],
                         'photo' => $path,
                     ];

                }

                MainCategory::insert($set_main_categories);
             }

             DB::commit();

             return redirect(route("admin.main-categories.index"))->with(['success' => __("admin.success create")]);


        } catch (\Exception $ex) {

            DB::rollback();
            return redirect(route("admin.main-categories.index"))->with(['error' => __("admin.message error")]);

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MainCategory $main_category)
    {
        return view("admin.main_categories.edit",compact("main_category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MainCategoryRequest $request, MainCategory $main_category)
    {


        $validated = array_values($request->category)[0];




         try{


             DB::beginTransaction();

                if ($request->has('photo')) {

                    $photo_to_delet = $main_category->photo ?? null;
                    $photo = $request->file("photo");
                    $path = imageUpload($photo, "main_categories");
                    $validated['photo'] = $path;

                    MainCategory::where("translation_of", $main_category->id)->update(['photo' => $path]);



                    deleteFile($photo_to_delet);


                }

                $main_category->update($validated);



             DB::commit();




             return redirect(route("admin.main-categories.index"))->with(['success' => __("admin.success create")]);

         }catch(\Exception $e){

             DB::rollback();

             return redirect(route("admin.main-categories.index"))->with(['error' => __("admin.message error")]);

         }





    }

    /**
     * Remove the specified resource from storage.
     * delet with othr translation
     * and remove photo
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainCategory $main_category)
    {

        if (isset($main_category->vendors) && $main_category->vendors->count() > 0) {
            return redirect(route("admin.main-categories.index"))->with(['error' => "sorry cant delete thos category because has vendors"]);
        }

        try{
             $main_category->delete();
             return redirect(route("admin.main-categories.index"))->with(['success' => __("admin.success delete")]);

        } catch (\Exception $ex) {
            return redirect(route("admin.main-categories.index"))->with(['error' => __("admin.message error")]);
        }

    }


/*
------------ chane status active
*/

    public function changeActive(MainCategory $main_category)
    {
        try {
             $status = $main_category->active == 1 ? 0 : 1;
             $main_category->update(['active' => $status]);
            return redirect(route("admin.main-categories.index"))->with(['success' => __("admin.success create")]);


        } catch(\Exception $ex) {
            return redirect(route("admin.main-categories.index"))->with(['error' => __("admin.message error")]);
        }

    }
}
