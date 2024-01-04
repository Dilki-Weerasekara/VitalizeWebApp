<?php

namespace App\Livewire;

use Livewire\Component;

class Waterfalls extends Component
{
    public function render()
    {
        return view('livewire.waterfalls')->extends("layouts.app");
    }
}
