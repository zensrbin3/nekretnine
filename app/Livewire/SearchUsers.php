<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search = '';

    public $type = '';

    public function render()
    {
        $properties = Property::query()->
        when($this->search,function ($query){
            $query->where('title','like','%'.$this->search.'%');
        })
            ->when($this->type !== 'all',function ($query){
                $query->where('type',$this->type);
            })
            ->limit(5)
            ->get();

        return view('livewire.search-users', compact('properties'));
    }
}

