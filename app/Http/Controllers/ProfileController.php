<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProfileController extends Controller
{
    public function show($userId)
    {
        return view('profile.show', ['user' => User::where('id',$userId)->first()]);
    }

    public function update(Request $request){
        $user=auth()->user();
        switch ($request->input('action')) {
            case "name":
                $request->validate([
                    "value" => "required|string|min:3"
                ]);
                $user->name=$request->value;
                $user->save();
                return response()->json(['success' => true, 'msg' => 'Ime izmenjeno.']);
            case "email":
                $request->validate([
                    "value" => "required|email"
                ]);
                $user->email = $request->value;
                $user->email_verified_at = null;
                $user->save();
                return response()->json(['success' => true, 'msg' => 'Email izmenjen.']);
            case "password":
                    $request->validate([
                        "value" => "required|string|min:8"
                    ]);
                    $user->password=bcrypt($request->value);
                    $user->save();
                    return response()->json(['success' => true, 'msg' => 'Lozinka izmenjena.']);
            case "verify":
                if($user->hasVerifiedEmail()){
                    return response()->json(['verified'=>true, 'msg'=>'Vec ste verifikovali email!']);
                }
                $user->sendEmailVerificationNotification();
                return response()->json(['verified' => false, 'msg' => 'Verifikacioni email poslat.']);
        }
        return response()->json(['success' => false, 'msg' => 'Nema lozinka.']);
    }
}
