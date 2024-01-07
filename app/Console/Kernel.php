<?php

namespace App\Console;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         // Define a scheduled task to run every minute.
        $schedule->call(function () {
            // Retrieve all posts with 'pending' status.
            $posts = Post::where("status", "pending")->get();

            foreach ($posts as $post) {
                // Make an API call to check for bad words in the post content.
                $collection = Http::withHeaders([
                    "content-type" => "text/plain",
                    "apiKey" => env("BAD_WORDS_API_KEY")
                ])->post('https://api.apilayer.com/bad_words', [
                    $post->content

                ])->collect();

                 // Check if any bad words are detected in the post.
                if ($collection["bad_words_total"] > 0) {
                      // If bad words are found, set the post status to 'rejected'.
                    $post->status = "rejected";
                    echo "rejected";
                    $post->save();
                    // Create a notification for the user about the post rejection.
                    Notification::create([
                        "user_id" => $post->user_id,
                        "type" => "post_status",
                        "message" => "Your Post has been rejected due to community guide lines",
                        "url" => "#",
                    ]);
                } else {
                    // If no bad words are found, set the post status to 'published'.
                    $post->status = "published";
                    echo "published";
                    $post->save();
                    // Create a notification for the user about the post publication.
                    Notification::create([
                        "user_id" => $post->user_id,
                        "type" => "post_status",
                        "message" => "Your Post has been published",
                        "url" => route("single-post", ["useruuid" => $post->user->uuid, "postuuid" => $post->uuid]),
                    ]);
                }
            }




            // Repeat the same process for comments.
            $comments = Comment::where("status", "pending")->get();

            foreach ($comments as $comment) {
                $collection = Http::withHeaders([
                    "content-type" => "text/plain",
                    "apiKey" => env("BAD_WORDS_API_KEY")
                ])->post('https://api.apilayer.com/bad_words', [
                    $comment->comment
                ])->collect();
                    
                if ($collection["bad_words_total"] > 0) {
                    $comment->status = "rejected";
                    echo "rejected";
                    $comment->save();
                    Notification::create([
                        "user_id" => $comment->user_id,
                        "type" => "post_status",
                        "message" => "Your Comment has been rejected due to community guide lines",
                        "url" => "#",
                    ]);
                } else {
                    $comment->status = "published";
                    echo "published";
                    $comment->save();
                    Notification::create([
                        "user_id" => $comment->user_id,
                        "type" => "post_status",
                        "message" => "Your Comment has been published",
                        "url" => route("single-post", ["useruuid" => $comment->user->uuid, "postuuid" => $comment->post->uuid]),
                    ]);
                }
            }
        })->everyMinute(); //The task is scheduled to run every minute.
    }




    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
