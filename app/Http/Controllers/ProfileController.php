<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($userId)
    {
        return view('profile.show', ['user' => User::where('id',$userId)->first()]);
    }
}
