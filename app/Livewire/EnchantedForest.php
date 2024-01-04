<?php

namespace App\Livewire;

use Livewire\Component;

class EnchantedForest extends Component
{
    public function render()
    {
        return view('livewire.enchanted-forest')->extends("layouts.app");
    }
}
