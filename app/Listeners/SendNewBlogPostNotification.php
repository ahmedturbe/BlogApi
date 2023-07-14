<?php

namespace App\Listeners;

use App\Events\NewBlogPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBlogPostNotification;

class SendNewBlogPostNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewBlogPost $event): void
    {
        $post = $event->getPost();
        Mail::to('ervin.cajic@gmail.com')
            ->send(new NewBlogPostNotification($post));
    }
}
