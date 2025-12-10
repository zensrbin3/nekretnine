<?php

namespace App\Services;

use App\Models\Property;

class PropertyService
{
    public function create(array $data)
    {
        $propertyCount = Property::where('user_id', auth()->id())->count();
        $data['property_count'] = $propertyCount + 1;
        $data['user_id'] = auth()->id();
        return Property::create($data);
        // za ovo bolje koristiti repository pattern zato sto radimo sa modelom
    }
}
