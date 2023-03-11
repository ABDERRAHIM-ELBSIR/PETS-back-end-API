<?php

namespace App\Http\Controllers;

use App\Models\Groups_posts;
use App\Models\Posts;
use App\Models\User;
use App\Models\Friend;
use App\Models\Files;
use App\Notifications\PostNotification;
use App\Traits\imgTrait;
use App\Traits\user_Trait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use imgTrait;
    use user_Trait;

    public function get_posts_of_myFriend()
    {
        $auth_user = Auth::user()->id;
        $friends = Friend::
            where('status', '=', true)
            ->where('request_from', '=', $auth_user)
            ->orwhere('request_to', '=', $auth_user)
            ->limit(20)
            ->get();

        if (!$friends) {
            return response()->json(null, 404);
        }

        foreach ($friends as $friend) {
            $posts = Posts::
                inRandomOrder()
                ->where('user_id', '=', $friend->request_to)
                ->orwhere('user_id', '=', $friend->request_from)
                ->limit(20)
                ->get();

            if (!$posts) {
                return response()->json([
                    "message" => "posts not found",
                    "status" => 404,
                ]);
            }
            $data = [];
            foreach ($posts as $post) {
                $post_file = $this->get_file_path($post->file_id);
                list($user_name, $user_img) = $this->get_user_info($post->user_id);

                $post_info = [
                    "user" => [
                        "id" => $post->user_id,
                        "name" => $user_name,
                        "profile_img" => $user_img
                    ],
                    "post" => [
                        "id" => $post->id,
                        "description" => $post->description,
                        "file" => $post_file,
                        "create_at"=>$post->create_at
                    ]
                ];
                array_push($data, $post_info);
            }
        }

        return response()->json([
            "data" => $data,
            "status" => 201,
        ]);

    }

    public function SendNotification($posts){
        
        $auth_user = Auth::user()->id;
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

        $user_create_post = Auth::user()->id;
        foreach ($friends as $friend) {
            $users = User::where('id', '=', $friend->request_to)->orwhere('id', '=', $friend->request_from)->get();
            Notification::send($users, new PostNotification($posts, $user_create_post));
        }
    }
    public function store(Request $request )
    { //store posts

        $file = $request->file('file');
        $file_id = $this->upload_img($file, "posts");

        //add type of file image|video|text

        $post_type = "text";
        if ($request->hasFile("file")) {
            $validator = Validator::make($request->all(), [
                'file' => 'image'
            ]);
            if (!$validator->fails()) {
                $post_type = "image";
            } else {
                $validator = Validator::make($request->all(), [
                    'file' => 'mimes:mp4,mov,ogg'
                ]);
                if (!$validator->fails()) {
                    $post_type = "video";
                }
            }
        }

        $auth_user = Auth::user()->id;

        $validate = Validator::make($request->all(), [
            'description' => 'required',
            'is_group_post' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }


        $posts = Posts::create([
            'description' => $request->description,
            'user_id' => $auth_user,
            'is_group_post' => $request->is_group_post,
            'type' => $post_type,
            'file_id' => $file_id,
        ]);
        if (!$posts) {
            return response()->json([
                "message" => "not acceptable",
                "status" => 406,
            ]);
        }

        //====================================$send notification for my fiends$===========================================
        // $friends = Friend::        $
        $this->SendNotification($posts);
        //     where('status', '=', true)
        //     ->where('request_from', '=', $auth_user)
        //     ->orwhere('request_to', '=', $auth_user)
        //     ->get();

        // if (!$friends) {
        //     return response()->json([
        //         'message' => 'friend not found',
        //         'status' => 200,
        //     ]);
        // }
        // $user_create_post = Auth::user()->id;
        // foreach ($friends as $friend) {
        //     $users = User::where('id', '=', $friend->request_to)->orwhere('id', '=', $friend->request_from)->get();
        //     Notification::send($users, new PostNotification($posts, $user_create_post));
        // }
        //====================================$send notification for my fiends$===========================================


        return response()->json([
            "data" => $posts,
            "message" => "post created",
            "status" => 201,
        ]);
    }

    public function update(Request $request, $id)
    {
        // $auth_user = Auth::user()->id;
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