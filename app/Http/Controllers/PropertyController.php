<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyView;
use App\Repositories\UserRepository;
use App\Services\PropertyService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    public function index(){
        return view('properties.property');
    }

    public function show($propertyId)
    {
        $property = Property::findOrFail($propertyId);

        $userId = auth()->id();
        $ip = request()->ip();
        $today = Carbon::today();

        $alreadyViewed = PropertyView::where('property_id', $property->id)
            ->whereDate('viewed_at', $today)
            ->when($userId, function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }, function ($q) use ($ip) {
                $q->where('ip_address', $ip);
            })
            ->exists();

        if (!$alreadyViewed) {
            PropertyView::create([
                'property_id' => $property->id,
                'user_id' => $userId,
                'ip_address' => $ip,
                'viewed_at' => now(),
            ]);
            $property->increment('views');
        }
        return view('properties.propertyView',['property'=>$property]);
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
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // svaka slika
        ]);
        $propertyCount = Property::where('user_id', auth()->id())->count();
        $data['property_count'] = $propertyCount + 1;

        $property = Property::create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'type' => $data['type'],
            'description' => $data['description'] ?? null,
            'property_count' => $data['property_count'],
            'location' => $data['location'],
            'price' => $data['price'],
            'size_m2' => $data['size_m2'],
            'status' => 'active',
        ]);

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $path = $image->store('properties/' . $property->id, 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'path'=> $path,
                ]);
            }
        }
        return redirect('/')->with('success', 'Uspešno ste dodali oglas!');
    }

}
