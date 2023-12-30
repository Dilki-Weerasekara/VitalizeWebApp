<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VideoPosts extends Component
{
    public $paginate_no = 10;   //number of items to be displayed per page 
    public $comment;

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }

    // comment function
    public function saveComment($post_id)
    {
        // validate the comment
        $this->validate([
            "comment" => "required|string"
        ]);
        DB::beginTransaction();   //start the datbase transactions
        try {

            // first or create a new comment to the post
            Comment::firstOrCreate([
                "post_id" => $post_id,   // get the post id
                "comment" => $this->comment,  //set the new comment
                "user_id" => auth()->id()    //authenticate the user
            ]);
            $post = Post::findOrFail($post_id);    //find the required post
            $post->comments += 1;   //increment the comment count by 1
            $post->save();   //save here
            DB::commit();   //commit the changes to the database
        } catch (\Throwable $th) {
            DB::rollBack();     //catch the errors
            throw $th;
        }
        unset($this->comment);    //destory the comment after publish it
    }



    // like function
    public function like($id)
    {
        DB::beginTransaction();  //start the datbase transactions
        try {
            Like::firstOrCreate(["post_id" => $id, "user_id" => auth()->id()]);    //create new like to the post by authenticating the user
            $post = Post::findOrFail($id);  //find the post
            $post->likes += 1;  //increment the like count by 1
            $post->save(); //save here
            DB::commit();  //commit the changes to the database
        } catch (\Throwable $th) {
            DB::rollBack(); //catch the errors
            throw $th;
        }
    }


    // dislike function
    public function dislike($id)
    {
        DB::beginTransaction();
        try {
            $like = Like::where(["post_id" => $id, "user_id" => auth()->id()])->first();   //search the liked post by authenticating the user
            $like->delete();     //delete the like
            $post = Post::findOrFail($id);  //find the required post
            $post->likes -= 1;  //decrease the like count
            $post->save();   //save here
            DB::commit();   //commit the changes to the database
        } catch (\Throwable $th) {
            DB::rollBack();   //catch the errors
            throw $th;
        }
    }


    public function render()
    {
         // Retrieve a collection of 'post_id's from 'PostMedia' where the 'file_type' is 'video'.
        // The 'latest()' method ensures that the most recent records are retrieved first.
        $posts = PostMedia::where("file_type", "video")->latest()->pluck("post_id");
         // Return the 'livewire.video-posts' view.
        return view('livewire.video-posts', [

            // The 'with("user")' method is eager loading the associated user for each post,
            // The 'latest()' method is used again to order these posts by their creation time.
            // Finally, the 'paginate()' method is used to paginate the posts based on the value of '$this->paginate_no'.

            'posts' => Post::whereIn("id", $posts)->with("user")->latest()->paginate($this->paginate_no)
        ])->extends("layouts.app");
    }


}
