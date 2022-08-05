<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\WebSite;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            "user_id" => "required|exists:users,id",
            "web_site_id" => "required|exists:web_sites,id",
        ],[
            "user_id.exists" => "User doesn't exists",
            "web_site_id.exists" => "Website doesn't exists."
        ]);

        if(Subscription::where("user_id", $request->user_id)->where("web_site_id", $request->web_site_id)->exists()){
            throw ValidationException::withMessages([
                "messages" => "User is already subscribed."
            ]);
        }

        Subscription::create([
            "user_id" => $request->user_id,
            "web_site_id" => $request->web_site_id,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Subscribed successfully.",
            "data" => null
        ]);
    }
}
