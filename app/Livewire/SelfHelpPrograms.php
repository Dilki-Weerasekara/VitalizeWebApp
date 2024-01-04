<?php

namespace App\Livewire;

use Livewire\Component;

class SelfHelpPrograms extends Component
{
    public function render()
    {
        return view('livewire.self-help-programs')->extends("layouts.app");
    }
}
