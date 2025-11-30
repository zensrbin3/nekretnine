<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return view('/home');
        }
        return view('auth/login')->with('error', 'Email or password combination incorrect.');
    }

    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

}
