<?php

namespace App\Http\Controllers;

use App\Jobs\PostCreatedJob;
use App\Models\Post;
use App\Models\Subscription;
use App\Notifications\PostNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "web_site_id" => "required|exists:web_sites,id",
            "title" => "required|unique:posts,title",
            "slug" => "required|unique:posts,slug",
            "description" => "nullable",
        ],[
            "web_site_id.exists" => "Website doesn't exists."
        ]);

        $post = Post::create([
            "title" => $request->title,
            "slug" => $request->slug,
            "description" => $request->description,
            "web_site_id" => $request->web_site_id,
        ]);

        $subscriptions = Subscription::where("web_site_id", $request->web_site_id)->with("subscriber")->get();
        dispatch(new PostCreatedJob($post,$subscriptions));

        return response()->json([
            "status" => "success",
            "message" => "Post Created.",
            "data" => $post
        ]);
    }
}
