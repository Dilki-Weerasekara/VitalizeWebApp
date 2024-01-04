<?php

namespace App\Livewire;

use Livewire\Component;

class CognitiveBehavioralTherapy extends Component
{
    public function render()
    {
        return view('livewire.cognitive-behavioral-therapy')->extends("layouts.app");
    }
}
