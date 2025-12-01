<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($user)
    {
        return view('profile.show',compact('user'));
    }
}
