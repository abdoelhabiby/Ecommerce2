<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function showLoginForm(){
        return view("admin.auth.login");
    }


    public function login(Request $request){

        // check validation

        $validate = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

         $remeber = $request->has("remember") ? true : false;

         if(auth()->guard("admin")->attempt([
             "email" => $request->email , "password" => $request->password
         ],$remeber)){

             return redirect()->route("admin.home");
         }



         session()->flash("failed", __("admin.login_failed"));

         return redirect()->back();



    }
}
