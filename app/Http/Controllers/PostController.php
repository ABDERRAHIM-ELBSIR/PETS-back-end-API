<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function get_posts_of_myFriend()
    {
        //code all post
    }
    public function store(Request $request)
    {
        //store posts
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
        $posts = Posts::create([
            'description' => $request->description,
            'user_id' => $auth_user,
            'is_group_post' => $request->is_group_post,
            'type' => $request->type,
            'file_id' => $request->file_id,
        ]);

        if (!$posts) {
            return response()->json([
                "message" => "not acceptable",
                "status" => 406,
            ]);
        }
        return response()->json([
            "data" => $posts,
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
    public function delete($id)
    {
        $post=Posts::find($id);
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