<?php

namespace App\Livewire;

use Livewire\Component;

class ViewGoogleForum extends Component
{
    public function render()
    {
        return view('livewire.view-google-forum')->extends("layouts.app");
    }
}
