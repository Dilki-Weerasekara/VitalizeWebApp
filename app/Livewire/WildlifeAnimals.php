<?php

namespace App\Livewire;

use Livewire\Component;

class WildlifeAnimals extends Component
{
    public function render()
    {
        return view('livewire.wildlife-animals')->extends("layouts.app");
    }
}
