<?php

namespace App\Http\Controllers;

use App\Notifications\likesNotification;
use Illuminate\Http\Request;
use App\Models\Likes;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Validator;

class LikesController extends Controller
{
    //show likes of post 
    public function show_likes($id)
    {
        $likes = Likes::where('post_id', '=', $id)
            ->count();

        if (!$likes) {
            return response()->json([
                'data' => 'no like to this post',
                'status' => 404
            ]);
        }
        return response()->json([
            'data' => $likes,
            'status' => 200
        ]);
    }
    //add like to post 
    public function add_likes(Request $request)
    {

        $auth_user = Auth::user()->id;
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'post_id' => 'required|integer',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }

        $likes = Likes::create([
            'user_id' => $auth_user,
            'post_id' => $request->post_id,
        ]);

        if (!$likes) {
            return response()->json([
                "message" => "not liket",
                "status" => 406,
            ]);
        }

        //===============send notification if liked=========================
        $post = Posts::find($request->post_id);

        if (!$post) {
            return response()->json([
                'message' => 'post not found',
                'status' => 404,
            ]);
        }
        $user = User::find($post->user_id);
        Notification::send($user, new likesNotification($likes,$user));
        //===============send notification if liked=========================

        return response()->json([
            "message" => "post liked",
            "status" => 201,
        ]);



    }
    public function delete_like($id)
    {
        $like = Likes::find($id);

        if (!$like) {
            return response()->json([
                "message" => "like not found",
                "status" => 404,
            ]);
        }

        $like->delete();

        return response()->json([
            "message" => "like deleted",
            "status" => 201,
        ]);
    }
}