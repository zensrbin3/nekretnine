<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request,$property_id)
    {
        if(Comment::create([
            'property_id' => $property_id,
            'user_id'=> auth()->user()->id,
            'comment'=> $request->comment,
            'created_at'=>Carbon::now()
        ])){
            return redirect()->back()->with('success','Comment added successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

}
