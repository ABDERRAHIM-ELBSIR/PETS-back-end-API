<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Likes;
use Illuminate\Support\Facades\Auth;
use Validator;
class LikesController extends Controller
{
    public function show_likes($id)
    {
        $likes = Likes::where('post_id', '=', $id)
        ->count();
        if(!$likes){
            return response()->json([
                'data'=>'no like to this post',
                'status'=>404
            ]);
        }
        return response()->json([
            'data'=>$likes,
            'status'=>200
        ]);
    }
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

        return response()->json([
            "message" => "post liked",
            "status" => 201,
        ]);
    }
    public function delete_like($id)
    {
        $like=Likes::find($id);
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