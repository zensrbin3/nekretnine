<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search='';
    public function render()
    {
        $properties = Property::where('title','like','%'.$this->search.'%')->limit(5)->get();
        return view('livewire.search-users',['properties'=>$properties]);
    }
}
