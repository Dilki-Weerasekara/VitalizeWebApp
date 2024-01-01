<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "uuid",
        'first_name',
        'last_name',
        'dob',
        'profile_type',
        'profession',
        'username',
        'email',
        'mobile',
        'mobile_verification_code',
        'email_verified_at',
        'mobile_verified_at',
        "description",
        "thumbnial",
        "profile",
        "gender",
        "relationship",
        "location",
        "address",
        "is_private",
        "is_banned",
        'password',
    ];

      /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Here check current user sent friend request to that peron or that person sent a friend request to current user.
    public function is_friend()
    {
        return (Friend::where(["user_id" => $this->id])->orWhere("friend_id", $this->id)->first()->status ?? "");
    }

    // mutual friend function
    public function mutual_friends()
    {
        // Retrieve all the friend connections where the current user is either the 'user_id' or 'friend_id'.
        // This fetches the IDs of all the rows in the 'friends' table that involve the current user.
        $my_friend_friends = Friend::where("user_id", $this->id)->OrWhere("friend_id", $this->id)->pluck("id")->toArray();

        // Retrieve all the friend connections of the authenticated user (the one making the request).
        // Similar to above, this fetches the IDs of all rows in the 'friends' table that involve the authenticated user.
        $my_friend = Friend::where("user_id", auth()->id())->OrWhere("friend_id", auth()->id())->pluck("id")->toArray();

        // Return the count of mutual friends.
        // 'array_intersect' computes the intersection of arrays,it finds common IDs between the two arrays.
        // This count represents the number of mutual friends between the current user and the authenticated user.
        return count(array_intersect($my_friend, $my_friend_friends));
    }

}



