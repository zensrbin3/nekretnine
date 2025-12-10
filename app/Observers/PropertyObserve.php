<?php
namespace App\Observers;

use App\Models\Property;
use Illuminate\Support\Facades\Log;
class PropertyObserve{
    public function created(Property $property){
        Log::info("Nova nekretnina dodata: {$property->title}, user_id: {$property->user_id}");
        //zapisuje se u log fajl u storage, ne direktno na ekranu, i to kasnije mozes da
        //koristis negde
    }
}
