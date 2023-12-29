<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Page;
use App\Models\PageLike;
use App\Models\Post;
use App\Models\SavedPost;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class Home extends Component
{
    public $paginate_no=5;
    public $comment;

    //comment function to the specific post
    public function saveComment($post_id)
    {
        $this->validate([
            "comment" => "required|string"   //validate the comment function
        ]);
        DB::beginTransaction();   //database transaction start
        try {
            Comment::firstOrCreate([        //first add or create new comment
                "post_id" => $post_id,
                "comment" => $this->comment,   //add the comment
                "user_id" => auth()->id()    //authenticate the user
            ]);
            $post = Post::findOrFail($post_id);    //find or fail to find required post
            $post->comments += 1;    //increment the comment count by 1
            $post->save();     //save here
            DB::commit();      //commit to the database
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        unset($this->comment);   //destroy the comment after submit
    }


    // like function to the specific post
    public function like($id)
    {
        DB::beginTransaction();
        try {
            Like::firstOrCreate(["post_id" => $id, "user_id" => auth()->id()]);   //first or create new like
            $post = Post::findOrFail($id);  //find or fail post id
            $post->likes += 1;   //increment the likes
            $post->save();   //save here
            DB::commit();  //commit the changes to the database

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    //dislike function

    public function dislike($id)
    {
        DB::beginTransaction();
        try {
            $like = Like::where(["post_id" => $id, "user_id" => auth()->id()])->first();   // first, find where the like appear
            $like->delete();   //delete the like
            $post = Post::findOrFail($id); //find or fail post id
            $post->likes -= 1;  //reduce one like
            $post->save();   //save here
            DB::commit();   //commit to the database

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function render()
    {
        return view('livewire.home',['posts'=>Post::with("user")->latest()->paginate($this->paginate_no)])->extends("layouts.app");
    }
}
