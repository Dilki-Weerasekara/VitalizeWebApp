<?php

namespace App\Livewire;

use Livewire\Component;

class Reminder extends Component
{
    public function render()
    {
        return view('livewire.reminder')->extends("layouts.app");
    }
}
