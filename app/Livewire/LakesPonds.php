<?php

namespace App\Livewire;

use Livewire\Component;

class LakesPonds extends Component
{
    public function render()
    {
        return view('livewire.lakes-ponds')->extends("layouts.app");
    }
}
