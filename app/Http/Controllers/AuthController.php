<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admins')->except('logout');
    }

    public function formLogin(){
        return view('login');
    }

    public function login(Request $request) { 
        // dd([$request->email, $request->password]);
        if(Auth::guard('admins')->attempt(['email'=>$request->email, "password" => $request->password])) {
            return redirect()->intended(route('admins.dashboard'));
        }
        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout() {
        Auth::guard('admins')->logout();
        return redirect('/');
    }
}
