<?php

namespace App\Livewire;

use Livewire\Component;

class GardenBlossoms extends Component
{
    public function render()
    {
        return view('livewire.garden-blossoms')->extends("layouts.app");
    }
}
