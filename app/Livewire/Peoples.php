<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Peoples extends Component
{
    use WithPagination;
    public $paginator = 10;
    public $search;

    public $listeners = [
        "load-more" => 'LoadMore'
    ];

    public function LoadMore()
    {
        $this->paginator = $this->paginator +8;
    }

    public function acceptfriend($id)
    {
        $user = User::where("id", $id)->first();

        DB::beginTransaction();
        try {
            $req = Friend::where([
                "user_id" => $id,
                "friend_id" => auth()->id(),
            ])->first();
            $req->status = "accepted";
            $req->save();
            Notification::create([
                "type" => "friend_accepted",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " accepted your friend request",
                "url" => "#",
            ]);


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatch('alert', [
            "type" => "success", "message" =>  "  friend request accepted "
        ]);
    }

    //add friend function here
    public function addfriend($id)
    {
        // retrieve the first (or only) user record that matches a given UUID. It's a common way to fetch a specific user's details in laravel
        $user = User::where("uuid", $id)->first();

        DB::beginTransaction();   //start the database transactions
        try {
            Friend::create([      // Create a new record in the 'friends' table
                "user_id" => auth()->id(),    // Set the 'user_id' column to the ID of the currently authenticated user
                "friend_id" => $user->id,   // Set the 'friend_id' column to the ID of the user object referenced by '$user'
            ]);
            Notification::create([   //create new record in the 'notification' table
                "type" => "friend_request", // Set the 'type' column to indicate the nature of the notification, in this case, a 'friend_request'.
                "user_id" => $user->id,   // Set the 'user_id' column to the ID of the user who will receive the notification.
                "message" => auth()->user()->username . " send you friend request",  //notification message
                "url" => "#", //after click the url user redirect to the information page
            ]);
            DB::commit();    //save to the database
        } catch (\Throwable $th) {     //catch the errors
            DB::rollBack();
            throw $th;
        }
        $this->dispatch('alert', [
            "type" => "success", "message" => "friend request send to " . $user->username
            // Set the message to be displayed in the alert. This message includes the username of the user to whom the friend request was sent.

        ]);
    }
    public function removefriend($id)
    {
        $user = User::where("uuid", $id)->first();

        DB::beginTransaction();
        try {
            Friend::where([
                "user_id" => auth()->id(),
                "friend_id" => $user->id,
            ])->first()->delete();
            Notification::create([
                "type" => "friend_request",
                "user_id" => $user->id,
                "message" => auth()->user()->username . " canceled friend request",
                "url" => "#",
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatch('alert', [
            "type" => "success", "message" => "friend request canceled from " . $user->username
        ]);
    }



    public function render()
    {
        //  Exclude the currently authenticated user from the results. This is achieved by using 'whereNotIn' and excluding the authenticated user's id.
        // Filter users whose 'username' contains the string stored in '$this->search'.
        $users = User::whereNotIn('id', [auth()->id()])->where("username", "like", "%" . $this->search . "%")

        // Randomize the order of the users. This is particularly useful for displaying users in a non-predictable order.
            ->inRandomOrder()
        // Paginate the results, showing a limited number of users per page.
        // Only select specific columns ('id', 'uuid', 'profile', 'first_name', 'last_name', 'username') to optimize the query.
            ->paginate($this->paginator, ["id", "uuid", "profile", "first_name", "last_name", "username"]);

        // Return the 'livewire.peoples' view, passing the retrieved 'users' and their pagination links.
        return view('livewire.peoples', [
            "users" => $users,
            "pagination" => $users->links()

        // Extend the 'layouts.app' layout. This is a common practice in Laravel to maintain a consistent layout across different views.
        ])->extends("layouts.app");
    }

}
