<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;
        if(auth()->guard('admin')->attempt(['email' => $request->input("email"),
         'password'=> $request->input("password")])){
        return route('admin.dashboard');
        // notify->success('تم التسجيل بنجاح');
    }
    // notify()->error('خطأ ف البيانات الرجاء المجاولة مرة اخري');
    return redirect()->back();
    }
}

