<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\ExploreNature;
use App\Livewire\ExploreNature2;
use App\Livewire\GardenBlossoms;
use App\Livewire\RainfallSerenity;
use App\Livewire\SeasideTranquility;
use App\Livewire\SkyStars;
use App\Livewire\Waterfalls;
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
use App\Livewire\Settings\AccountInformation;
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
    Route::get('/', Home::class)->name("home");  //home page or dashboard page
    Route::get('/videos', VideoPosts::class)->name("videos");   //videopost route
    Route::get('/explore', Peoples::class)->name("explore");   //explore or find the friends
    Route::get('/search', Search::class)->name("search");    //search bar
    Route::get('/user/{uuid}', User::class)->name("user");  // user timeline
    Route::get('/post/{useruuid}/{postuuid}', SinglePost::class)->name("single-post");   //view a wallpost as single page post

    //user resource pages
     Route::get('/explore_nature', ExploreNature::class)->name("nature");  //nature video section
     Route::get('/select_rainfall', RainfallSerenity::class)->name("user_select_rainfall");  //rainfall video section
     Route::get('/select_garden&blossoms', GardenBlossoms::class)->name("user_select_garden&blossoms");//garden and blossoms video section
     Route::get('/select_waterfalls', Waterfalls::class)->name("user_select_waterfalls"); //waterfalls page
     Route::get('/select_skystars', SkyStars::class)->name("user_select_skystars"); //SkyStars page
     Route::get('/select_seaside', SeasideTranquility::class)->name("user_select_seaside");  //Seaside page
     Route::get('/explore_nature2', ExploreNature2::class)->name("nature2");  //nature video section


    //group sections
    Route::get('/groups', Groups::class)->name("groups");
    Route::get('/groups/{uuid}', Group::class)->name("group");
    Route::get('/group/create', CreateGroup::class)->name("create-group");

      // users settings
    Route::prefix('user-profile')->group(function () {
        Route::get('/', Setting::class)->name("settings");
        Route::get('/settings', AccountInformation::class)->name("settings.account_information");  //account information
        Route::get('/saved-items', SavedPosts::class)->name("settings.saved_posts");  //saved posts
        Route::get('/reset-password', PasswordUpdate::class)->name("settings.password_update"); //password change
        Route::get('/help', Help::class)->name("settings.help");  //helpdesk
    });


});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


require __DIR__.'/auth.php';
