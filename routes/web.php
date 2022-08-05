<?php

use App\Jobs\PostCreatedJob;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\PostNotify;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    // $user = User::find(1);
    // $user->load('website');
    // dd($user);
    $post = Post::first();
    $subscritions = Subscription::where("web_site_id", "1")->with("subscriber")->get();
    dispatch(new PostCreatedJob($post,$subscritions));
});


