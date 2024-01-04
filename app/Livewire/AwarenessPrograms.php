<?php

namespace App\Livewire;

use Livewire\Component;

class AwarenessPrograms extends Component
{
    public function render()
    {
        return view('livewire.awareness-programs')->extends("layouts.app");
    }
}
