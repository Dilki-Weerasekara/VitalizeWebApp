<?php

namespace App\Livewire\Components;


use Livewire\Component;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Str;


class CreatePost extends Component
{
    public $content;

    public function render()
    {
        return view('livewire.components.create-post');
    }

    // submit the create post to the database
    public function createpost(){

        // validate the content before submit
        $this->validate([
            "content" => "required|string",
        ]);


        Post::create([
            "uuid" => Str::uuid(),
            "user_id" => auth()->id(),
            "content" => $this->content,
        ]);

        unset($this->content);

        // alert message to the user

         $this->dispatch('alert', [
             'type' => 'success', // or 'info', 'warning', 'error'
             'message' => 'Your post will be published shortly.'
        ]);


    }

}
