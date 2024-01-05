<?php

namespace App\Livewire;

use Livewire\Component;

class Assesment extends Component
{
    public function render()
    {
        return view('livewire.assesment')->extends("layouts.app");
    }
}
