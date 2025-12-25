<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(RegisterRequest $request){
        if(User::create($request->validated()))
            return redirect()->route('register')->with('success', 'Registration Successful');
        return redirect()->route('register')->with('error', 'Registration Failed');
    }

}
