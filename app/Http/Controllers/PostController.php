<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use App\Models\Friend;
use App\Models\Files;
use App\Notifications\PostNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function get_posts_of_myFriend()
    {
        $auth_user = Auth::user()->id;
        $friends = Friend::
            where('status', '=', true)
            ->where('request_from', '=', $auth_user)
            ->orwhere('request_to', '=', $auth_user)
            ->get();

        if (!$friends) {
            return response()->json(null, 404);
        }
        $posts = [];
        foreach ($friends as $friend) {
            $post = Posts::where('user_id', '=', $friend->request_to)->orwhere('user_id', '=', $friend->request_from)->get();
            array_push($posts, $post);
        }

        return response()->json([
            "data" => $posts,
            "message" => "posts of your friends",
            "status" => 201,
        ]);

    }
    public function store(Request $request)
    { //store posts

        $file_id = $request->file('file_id');
        $file_id_data = null;
        if ($file_id != null) {
            $image_path = $file_id->store('images/Posts', 'chat_imgs');
            $data = Files::create([
                "type" => "image/png",
                "size" => 20025,
                //change name to refer_to id 
                'name' => 'default',
                //add type of refer_to  
                "file" => "storage/" . $image_path
            ]);
            $file_id_data = $data;
        }
    
        $auth_user = Auth::user()->id;
        $validate = Validator::make($request->all(), [
            'description' => 'string',
            'user_id' => 'required|integer',
            'is_group_post' => 'required',
            'type' => 'required|string',

        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }
        
        if ($file_id_data != null) {
            $file_id_data = $file_id_data->id;
        }

        $posts = Posts::create([
            'description' => $request->description,
            'user_id' => $auth_user,
            'is_group_post' => $request->is_group_post,
            'type' => $request->type,
            'file_id' => $file_id_data,
        ]);

        if (!$posts) {
            return response()->json([
                "message" => "not acceptable",
                "status" => 406,
            ]);
        }
        //====================================$send notification for my fiends$===========================================
        $friends = Friend::
            where('status', '=', true)
            ->where('request_from', '=', $auth_user)
            ->orwhere('request_to', '=', $auth_user)
            ->get();

        if (!$friends) {
            return response()->json([
                'message' => 'friend not found',
                'status' => 200,
            ]);
        }
        $user_create_post=Auth::user();
        foreach ($friends as $friend) {
            $users = User::where('id', '=', $friend->request_to)->orwhere('id', '=', $friend->request_from)->get();
            Notification::send($users, new PostNotification($posts,$user_create_post));
        }
        //====================================$send notification for my fiends$===========================================


        return response()->json([
            "data" => $posts,
            "frends" => $friends,
            "users" => $users,
            "message" => "post created",
            "status" => 201,
        ]);
    }

    public function update(Request $request, $id)
    {
        $auth_user = Auth::user()->id;
        $validate = Validator::make($request->all(), [
            'description' => 'string',
            'user_id' => 'required|integer',
            'is_group_post' => 'required',
            'type' => 'required|string',
            'file_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }

        $post = Posts::find($id);

        if (!$post) {
            return response()->json([
                "message" => "not found post",
                "status" => 404,
            ]);
        }

        $post->update($request->all());
        return response()->json([
            "data" => $post,
            "message" => "post updated",
            "status" => 201,
        ]);
    }
    public function delete_post($id)
    { //delete post 
        $post = Posts::find($id);

        if (!$post) {
            return response()->json([
                "message" => "not found post",
                "status" => 404,
            ]);
        }
        $post->delete();

        return response()->json([
            "message" => "post deleted",
            "status" => 201,
        ]);

    }
}