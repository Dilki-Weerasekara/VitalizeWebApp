<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\SavedPost;

class SavedPosts extends Component
{
    public $paginate_no = 9;

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }
    public function render()
    {
        return view('livewire.settings.saved-posts',[
            "posts"=>SavedPost::where("user_id",auth()->id())->latest()->paginate($this->paginate_no)
        ])->extends("layouts.app");
    }
}
