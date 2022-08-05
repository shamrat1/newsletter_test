<?php

namespace App\Jobs;

use App\Mail\PostCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PostCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $post, $subscriptions = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post, $subscriptions)
    {
        $this->post = $post;
        $this->subscriptions = $subscriptions;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->subscriptions as $subscription){
    
            $email = new PostCreatedMail($this->post);
            Mail::to($subscription->subscriber->email)->send($email);
        }
    }
}

