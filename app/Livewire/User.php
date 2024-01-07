<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelsUser;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Support\Facades\DB;


class User extends Component
{

    public $uuid;
    public $loader;

    public $paginate_no = 20;
    public $comment;
    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }


    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->loader = 1;
    }

    // add friend function
    public function addfriend($id)
    {
        $user = ModelsUser::where("uuid", $id)->first();

        DB::beginTransaction();
        try {
            Friend::create([
                "user_id" => auth()->id(),
                "friend_id" => $user->id,
            ]);
            Notification::create([
                "type" => "friend_request",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " send you friend request",
                "url" => "#",
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" => "friend request send to " . $user->username
        ]);
    }

    // remove friend function
    public function removefriend($id)
    {

        DB::beginTransaction();
        try {
            $req = Friend::findOrFail($id);
            $temp = $req->user_id == auth()->id() ? $req->friend_id : $req->user_id;
            Notification::create([
                "type" => "friend_request",
                "user_id" => $temp,
                "message" => auth()->user()->username . " canceled friend request",
                "url" => "#",
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" => "friend request canceled from " . ModelsUser::find($temp)->username
        ]);
    }

    // toggle button function
    public function toggle()
    {
        $this->loader = !$this->loader;
    }


    // comment save function
    public function saveComment($post_id)
    {
        $this->validate([
            "comment" => "required|string"
        ]);
        DB::beginTransaction();
        try {
            Comment::firstOrCreate([
                "post_id" => $post_id,
                "comment" => $this->comment,
                "user_id" => auth()->id()
            ]);
            $post = Post::findOrFail($post_id);
            $post->comments += 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        unset($this->comment);
    }


    // post like function
    public function like($id)
    {
        DB::beginTransaction();
        try {
            Like::firstOrCreate(["post_id" => $id, "user_id" => auth()->id()]);
            $post = Post::findOrFail($id);
            $post->likes += 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    // post dislike function
    public function dislike($id)
    {
        DB::beginTransaction();
        try {
            $like = Like::where(["post_id" => $id, "user_id" => auth()->id()])->first();
            $like->delete();
            $post = Post::findOrFail($id);
            $post->likes -= 1;
            $post->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


        public function render()
    {
        // Retrieve a user by their UUID, or fail with an exception if not found.
        $user = ModelsUser::where("uuid", $this->uuid)->firstOrFail();

        // Fetch IDs of all 'published' posts belonging to the user.
        $posts_ids = Post::where(["user_id" => $user->id, "status" => "published"])->pluck("id");


        if ($this->loader == 1) {
            // If 'loader' is set to 1, retrieve all posts of the user where stauts is published.
        
            $posts = Post::where([
                "user_id" => $user->id,
                "status" => "published"
            ])->latest()->get();

            // Fetch all post media for these posts where the file type is 'image'.
            $post_media = PostMedia::whereIn("post_id", $posts_ids)->where("file_type", "image")->get();

            // Return the 'livewire.user' view, passing the user, their posts, and associated media.
            // This view extends the 'layouts.app' layout.
            return view('livewire.user', [
                "user" => $user,
                "posts" => $posts,
                "post_media" => $post_media
            ])->extends("layouts.app");
        } else {

            //this section set to display all the media files in seperate section.
            // If 'loader' is not set to 1, fetch the IDs of all post media belonging to the user's posts.
            $posts_media = PostMedia::whereIn("post_id", $posts_ids)->pluck("post_id");

            // Return the 'livewire.user-media' view, passing the user and their posts based on media IDs.
            // This view extends the 'layouts.app' layout.
            return view('livewire.user-media', [
                "user" => $user,
                "posts" => Post::whereIn("id", $posts_media)->get(),
            ])->extends("layouts.app");
        }
    }

}
