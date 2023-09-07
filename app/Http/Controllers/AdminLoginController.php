<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function login()
    {
        return view('admin.layout.login');
    }
    public function getLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return redirect()->route('home')->with('sucess', 'تم تسجيل الدخول بنجاح');
        } else {
            return redirect()->route('login')
                ->with('error', 'حدث خطا فى معلومات التسجيل الدخول');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')
            ->with('success', 'تم تسجيل الخرروج بنجاح');
    }
}
