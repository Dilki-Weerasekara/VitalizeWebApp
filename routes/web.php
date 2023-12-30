<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\SinglePost;
use App\Livewire\Peoples;
use App\Livewire\Components\CreatePage;
use App\Livewire\CreateGroup;
use App\Livewire\Group;
use App\Livewire\Groups;
use App\Livewire\Page;
use App\Livewire\Pages;
use App\Livewire\Profile;
use App\Livewire\Search;
use App\Livewire\Settings\AccountInformaiton;
use App\Livewire\Settings\Help;
use App\Livewire\Settings\Notifications;
use App\Livewire\Settings\PasswordUpdate;
use App\Livewire\Settings\SavedPosts;
use App\Livewire\Settings\Setting;
use App\Livewire\Settings\Socials;
use App\Livewire\Test;
use App\Livewire\User;
use App\Livewire\VideoPosts;
use App\Models\Post;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Env;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 //dont allow users to see anything until they are authorize and verify the email or mobile verification after login.
Route::middleware(["auth", "verified", 'VerifiedUser'])->group(function () {
    Route::get('/', Home::class)->name("home");
    Route::get('/videos', VideoPosts::class)->name("videos");   //videopost route
    Route::get('/post/{useruuid}/{postuuid}', SinglePost::class)->name("single-post");   //view a wallpost as single page post

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
