<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Story;
use Carbon\Carbon;
use Livewire\WithFileUploads;


class Stories extends Component
{

    public $images;
    use WithFileUploads;

    // store personal stories in the database
    public function updatedImages()
    {
        // select the multiple images using array
        $images = [];

        // run throuh loop to get multiple images
        foreach ($this->images as $image) {
            //store the story images in storage public directory
            $images[] = $image->store("stories", 'public');
        }

        // create the personal story
        Story::create([
            "user_id" => auth()->id(),    //authenticate the user
            "story" => json_encode($images),     //encode the story images
            "status" => 1,       //set status to 1
        ]);

        unset($this->images);   //destory the story from the user interface after submit
        return redirect("/");

    }


    public function render()
    {
       // This function is responsible for rendering the stories view component.
       
        return view('livewire.components.stories',[

                // 1. Only stories created within the last 24 hours (using now()->subDay() to get the time 24 hours ago).
                // 2. Using 'latest()' to order the results by creation time, with the most recent stories first.
                // 3. The 'unique("user_id")' method ensures that only one story per user is selected, avoiding duplicates from the same user.

                "stories"=>Story::where("created_at",">=",now()->subDay())->latest()->get()->unique("user_id")
        ]);
    }
}
