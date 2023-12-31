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
    public $paginate_no = 9;
    public $comment;
    public $hide_user_list = [];

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginate_no = $this->paginate_no + 3;
    }

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


        public function acceptfriend($id)
    {
        // Retrieve the user who sent the friend request, based on the provided ID.
        $user = User::where("id", $id)->first();

        // Start a database transaction. This ensures that all database operations
        // either complete successfully together or get rolled back together in case of an error.
        DB::beginTransaction();
        try {
            // Retrieve the friend request from the database where the current user
            // is the recipient, and the status of the request is 'pending'.
            $req = Friend::where([
                "user_id" => $id,
                "friend_id" => auth()->id(),
                "status" => "pending"
            ])->first();

            // Update the status of the friend request to 'accepted' and set the accepted time.
            $req->status = "accepted";
            $req->accepted_at = now();
            $req->save(); // Save the changes to the database.

            // Create a notification for the user who sent the friend request to inform
            // them that their request has been accepted.
            Notification::create([
                "type" => "friend_accepted",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " accepted your friend request",
                "url" => "#", // link to a relevant page.
            ]);

            // Commit the transaction to the database.
            DB::commit();
        } catch (\Throwable $th) {
            // In case of an error, roll back the transaction to undo any changes made.
            DB::rollBack();
            throw $th; // Re-throw the exception to handle it elsewhere or log it.
        }

        // Dispatch a browser event to notify the current user that the friend request
        // has been successfully accepted. This is for immediate feedback on the user interface.
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" => "friend request accepted"
        ]);
    }



        public function rejectfriend($id)
    {
        // Retrieve the user who sent the friend request using the provided ID.
        $user = User::where("id", $id)->first();

        // Start a database transaction to ensure all changes are executed successfully.
        DB::beginTransaction();
        try {
            // Find the friend request where the current user is the recipient.
            $req = Friend::where([
                "user_id" => $id,
                "friend_id" => auth()->id(),
            ])->first();

            // Update the friend request status to 'rejected'.
            $req->status = "rejected";
            $req->save(); // Save the change to the database.

            // Create a notification for the user who sent the request, indicating it was rejected.
            Notification::create([
                "type" => "friend_rejected",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " rejected your friend request",
                "url" => "#", // link to a relevant page.
            ]);


            // Commit the transaction to save all database changes.
            DB::commit();
        } catch (\Throwable $th) {
            // In case of an error, roll back the transaction to revert all changes.
            DB::rollBack();
            throw $th; // Re-throw the exception for further handling or logging.
        }

        // Dispatch a browser event to notify the current user that the friend request
        // has been successfully rejected. This provides immediate feedback on the user interface.
        $this->dispatchBrowserEvent('alert', [
            "type" => "success", "message" => "friend request rejected"
        ]);
    }


    // function for join group
    public function join($id)
    {
        $group = Group::findOrFail($id);
        DB::beginTransaction();
        try {


            GroupMember::create([
                "user_id" => auth()->id(),
                "group_id" => $group->id
            ]);
            $group->members += 1;
            $group->save();
            Notification::create([
                "type" => "page_liked",
                "user_id" => $group->user_id,
                "message" => auth()->user()->username . " joined your group " . $group->name,
                "url" => "#",
            ]);

            $this->dispatchBrowserEvent('alert', [
                "type" => "success", "message" =>  " you joined " . $group->name
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function render()
    {

        //get the user already registered groups here as my groups
        $my_groups = GroupMember::where("user_id", auth()->id())->pluck("group_id");

        return view('livewire.home',[

            'posts'=>Post::with("user")->latest()->paginate($this->paginate_no),
            'friend_requests' => Friend::where(["friend_id" => auth()->id(), "status" => "pending"])->with("user")->latest()->take(5)->get(),
            //suggest the new groups for user
            "suggested_groups" => Group::whereNotIn("id", $my_groups)->inRandomOrder()->take(2)->get()
            ])->extends("layouts.app");

    }
}
