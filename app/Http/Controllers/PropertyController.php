<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function index(){
        return view('properties.property');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'size_m2' => 'required|integer',
        ]);
        $propertyCount = Property::where('user_id', auth()->user()->id)->count();
        $data['property_count'] = $propertyCount + 1;
        $data['user_id'] = auth()->id();
        Property::create($data);
        return redirect('/')->with('success', 'Uspešno ste dodali oglas!');
    }

}
