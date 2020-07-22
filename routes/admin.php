<?php


use Illuminate\Support\Facades\Route;

define("PAGINATE_COUNT",10);

Route::group(["namespace" => "Admin"],function(){

    route::group(["middleware" => "auth:admin"],function(){

        Route::get("/", "HomeController@index")->name("admin.home");



        Route::resources([
            'languages'=> 'LanguagesController',
            'main-categories'=> 'MainCategoryController',
        ], [
            'as' => "admin","except" => "show"
            ]);







        Route::get("logout",function(){
            auth("admin")->logout();
        });

    });




    Route::group(['middleware' => "guest:admin"],function(){

        Route::get("/login", "Auth\LoginController@showLoginForm")->name("admin.login");

        Route::post("/login", "Auth\LoginController@login")->name("admin.login");
    });

});
