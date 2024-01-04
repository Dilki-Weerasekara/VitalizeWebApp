<?php

namespace App\Livewire;

use Livewire\Component;

class InspirationalContent extends Component
{
    public function render()
    {
        return view('livewire.inspirational-content')->extends("layouts.app");
    }
}
