<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Language;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;

class LanguagesController extends Controller
{

    public function index(){

        $languages = Language::selection()->paginate(PAGINATE_COUNT);

        return view("admin.languages.index",compact("languages"));
    }


    //==============================================================


    public function create(){

        return view("admin.languages.create");

    }


    //==============================================================

    public function store(LanguageRequest $request){



         try {
            Language::create($request->validated());

            return redirect(route("admin.languages.index"))->with(['success' => __("admin.success create")]);

        } catch (\Exception $ex) {
             return redirect(route("admin.languages.index"))->with(['error' =>__("admin.message error")]);

        }
    }


    //==============================================================

    public function edit(Language $language){

        return view("admin.languages.edit",compact("language"));
    }
    //==============================================================

    public function update(Language $language, LanguageRequest $request){

        try{

            $language->update($request->validated());

            return redirect(route("admin.languages.index"))->with(['success' => __("admin.success create")]);

        }catch(\Exception $ex){
            return redirect(route("admin.languages.index"))->with(['error' =>__("admin.message error")]);

        }

    }
    //==============================================================

    public function destroy(Language $language){
        try {

            $language->delete();

            return redirect(route("admin.languages.index"))->with(['success' => __("admin.success delete")]);
        } catch (\Exception $ex) {
            return redirect(route("admin.languages.index"))->with(['error' => __("admin.message error")]);
        }
    }
    //==============================================================


}
