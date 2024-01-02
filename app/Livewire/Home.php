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

        // $this->dispatchBrowserEvent('alert', [
        //     "type" => "success", "message" => "friend request accepted"
        // ]);
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

        // $this->dispatchBrowserEvent('alert', [
        //     "type" => "success", "message" => "friend request rejected"
        // ]);
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

            // $this->dispatchBrowserEvent('alert', [
            //     "type" => "success", "message" =>  " you joined " . $group->name
            // ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->route("groups");

    }


    // saved the post
    public function save($post_id)
    {
        // Create a new 'SavedPost' record, or retrieve the existing one if it already exists.
        // This ensures that a user can save a post only once.
        SavedPost::firstOrCreate([
            "user_id" => auth()->id(),  // Set the 'user_id' to the ID of the currently authenticated user.
            "post_id" => $post_id  // Set the 'post_id' to the ID of the post being saved.
        ]);

        // Dispatch a browser event to show a success message.
        // This provides immediate feedback to the user that the item has been saved.
        
        // $this->dispatch('alert', [
        //     'type' => 'success',
        //     'message' => 'Item Saved'
        // ]);

    }


    //hide all posts of group/page/friends
    public function hide_all_from($type, $id)
    {
        if ($type == "user") {
              // Fetch the friendship relation with the given user ID.
            $friendship = Friend::where("user_id", $id)->orWhere("friend_id", $id)->first();
            if ($friendship) {
                 // If a friendship exists, change its status to 'rejected' and save.
                $friendship->status = "rejected";
                $friendship->save();
            } else {
                // If no friendship exists, add the user ID to a list of users to hide.
                $this->hide_user_list[] = $id;
            }
        } elseif ($type == "group") {
            // Handle hiding a group by setting the member status to 'inactive'.
            $member = GroupMember::where(["group_id" => $id, "user_id" => auth()->id()])->first();
            if ($member) {
                $member->status = "inactive";
                $member->save();
            }
        } elseif ($type == "page") {
             // Handle hiding a page by deleting the page like record.
            $member = PageLike::where(["page_id" => $id, "user_id" => auth()->id()])->first();
            if ($member) {
                $member->delete();
            }
        }

         // display the notifications in home page
         Notification::create([
            "type" => "hide_post",
            "user_id" => auth()->id(),
            "message" =>  "Hide all posts of $type successfully.",
            "url" => "#",
        ]);

        return redirect()->route("home");

    }



    public function render()
    {

        //get the user already registered groups here
        $my_groups = GroupMember::where("user_id", auth()->id())->pluck("group_id");

        // get a list of all the friend IDs associated with the currently authenticated user
        $friend_ids = Friend::where(["user_id" => auth()->id()])->pluck("friend_id");


        // Retrieve only friends' posts to display on the home wall
        // Fetching friends where the current user is either the 'user_id' or 'friend_id' and the friendship is accepted.
        // Convert the result to an array.
      $all_friends_aids = Friend::where(["user_id" => auth()->id(), "status" => "accepted"])->OrWhere(['friend_id' => auth()->id(), "status" => "accepted"])->get(["user_id", "friend_id"])->toArray();

      $filtered_friends_ids = [];  // Initialize an empty array to store the filtered friend IDs.

      // Loop through each item in the fetched friend relationships.
      foreach ($all_friends_aids as $item) {
        // If the 'user_id' in the item is the same as the authenticated user's ID, add the 'friend_id' to the filtered list.
        // Otherwise, add the 'user_id'. This effectively collects the IDs of the user's friends.
          $filtered_friends_ids[] = ($item['user_id'] == auth()->id() ? $item['friend_id'] : $item['user_id']);
      }

      $posts = Post::where("status","published")->latest()->paginate($this->paginate_no);

        return view('livewire.home',[

            'posts' => $posts,

            'friend_requests' => Friend::where(["friend_id" => auth()->id(), "status" => "pending"])->with("user")->latest()->take(5)->get(),
            //suggest the new groups for user
            "suggested_groups" => Group::whereNotIn("id", $my_groups)->inRandomOrder()->take(2)->get(),

            //suggest new friends to user
             'suggested_friends' => User::whereNotIn("id", $friend_ids)
                            ->where('id', '!=', auth()->id()) // Exclude the current user
                            ->inRandomOrder()
                            ->take(3)
                            ->get()

            ])->extends("layouts.app");

    }
}
