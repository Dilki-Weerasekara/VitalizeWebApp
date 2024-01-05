<?php

namespace App\Livewire;

use Livewire\Component;

class ScanQRCode extends Component
{
    public function render()
    {
        return view('livewire.scan-q-r-code')->extends("layouts.app");
    }
}
