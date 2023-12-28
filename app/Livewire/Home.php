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
    public function render()
    {
        return view('livewire.home',['posts'=>Post::with("user")->latest()->paginate($this->paginate_no)])->extends("layouts.app");
    }
}
