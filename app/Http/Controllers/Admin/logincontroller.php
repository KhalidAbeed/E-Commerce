<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\loginrequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class logincontroller extends Controller
{
    public function index()
    {
        return view('admin.dashbord');
    }
    public function getlogin()
    {
        return view('admin.Auth.login');

    }

    public function login(loginrequest $request)
    {
        $remember = $request->has('remember_me') ? true : false;
        if(auth()->guard('admin')->attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ])){
            return redirect()->route('admin.dashbord');
        }
        return redirect()->back()->with(['error' => 'خطأ ف البيانات']);

    }
}
