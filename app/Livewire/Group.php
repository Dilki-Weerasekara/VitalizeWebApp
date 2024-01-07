<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Group as ModelsGroup;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostMedia;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Group extends Component
{
    public $uuid;
    public $paginator = 10;


    public $comment;

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginator = $this->paginator + 3;
    }

    // save comment function
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


    // like function for group posts
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

    //dislike function for group posts
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

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

        public function render()
    {
        // Retrieve the group by its UUID or fail with an exception if not found.
        $group = ModelsGroup::where("uuid", $this->uuid)->firstOrFail();

        // Fetch IDs of all 'published' posts that belong to the specified group.
        $posts_ids = Post::where("status", "published")->where("group_id", $group->id)->pluck("id");

        // Retrieve all post media (images) associated with the fetched post IDs.
        $post_media = PostMedia::whereIn("post_id", $posts_ids)->where("file_type", "image")->get();

        // Fetch and paginate posts belonging to the group, ordered by the latest first.
        $posts = Post::where([
            "group_id" => $group->id,
            "status" => "published"
        ])->latest()->paginate($this->paginator);


        // Return the 'livewire.group' view with the group data, its posts, and associated images.
        // The view extends the 'layouts.app' layout for consistent application structure.
        return view('livewire.group', [
            "group" => $group,
            "posts" => $posts,
            "group_images" => $post_media
        ])->extends("layouts.app");
    }

}
