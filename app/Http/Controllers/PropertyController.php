<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Repositories\UserRepository;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    public function index(){
        $users=$this->userRepository->all();
        return view('properties.property',['users'=>$users]);
        //return view('properties.property');
    }

    public function store(Request $request)
    {
        $service = new PropertyService();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'size_m2' => 'required|integer',
        ]);
        $service->create($data);
        return redirect('/')->with('success', 'Uspešno ste dodali oglas!');
    }

}
