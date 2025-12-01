<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048'
        ]);
        $user = auth()->user();
        if ($user->photo && \Storage::disk('public')->exists('profile_photos/'.$user->photo)) {
            \Storage::disk('public')->delete('profile_photos/'.$user->photo);
        }
        $filename = time().'_'.$request->photo->getClientOriginalName();
        $request->photo->storeAs('profile_photos', $filename, 'public');
        $user->update(['photo' => $filename]);
        return response()->json([
            'success' => true,
            'photo_url' => asset('storage/profile_photos/'.$filename)
        ]);
    }

}
