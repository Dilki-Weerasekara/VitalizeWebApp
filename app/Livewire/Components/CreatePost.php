<?php

namespace App\Livewire\Components;


use Livewire\Component;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Str;


class CreatePost extends Component
{
    use WithFileUploads;
    public $content;
    public $images;
    public $video;

    public $type;
    public $iid;

    public function mount($type = "Normal", $id = Null)
    {
        $this->type = $type;
        $this->iid = $id;
    }


    public function render()
    {
        return view('livewire.components.create-post');
    }

    // submit the create post text to the database
    public function createpost(){

        // validate the content before submit
        $this->validate([
            "content" => "required|string",
        ]);

        //submit to the database
        DB::beginTransaction();
        try {
            // creating post to submit to the database.
            $post = Post::create([
                "uuid" => Str::uuid(),
                "user_id" => auth()->id(),
                "is_group_post" => $this->type == "group" ? 1 : 0,
                "is_page_post" => $this->type == "page" ? 1 : 0,
                "group_id" => $this->type == "group" ? $this->iid : Null,
                "page_id" => $this->type == "page" ? $this->iid : Null,
                "content" => $this->content,
                'status' => 'pending'
            ]);

            $images = [];   //set images to the array
            // if post include media
            if ($this->images) {
                foreach ($this->images as $image) {
                    $images[] = $image->store("posts/images", "public");
                }
                PostMedia::create([
                    "post_id" => $post->id,
                    "file_type" => "image",
                    "file" => json_encode($images),
                    "position" => "general",
                ]);
            }


            $video_file_name = "";
            if ($this->video) {
                $video_file_name = $this->video->store("posts/video", "public");
                PostMedia::create([
                    "post_id" => $post->id,
                    "file_type" => "video",
                    "file" => $video_file_name,
                    "position" => "general",
                ]);
            }


            DB::commit();

            //catch the database erros while uploading
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        unset($this->content);  //destory the content display in user interface after submit to the database.
        unset($this->images);
        unset($this->video);

        // alert message to the user

        //  $this->dispatchBrowserEvent('alert', [
        //      'type' => 'success',
        //       'message' => 'Your post will be published shortly.'
        //  ]);


         session()->flash('alert', [
            'type' => 'success',
            'message' => 'Your action was successful!'
        ]);

        return redirect()->route("home");

    }

}
