<?php

namespace App\Livewire;

use Livewire\Component;

class ExploreNature extends Component
{
    public function render()
    {
        return view('livewire.explore-nature')->extends("layouts.app");
    }
}
