<?php

namespace App\Http\Controllers;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;
use Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function Show_Num_Comment($id)
    {
        $comment= Comments::where('post_id', '=', $id)
        ->count();
        if(!$comment){
            return response()->json([
                'data'=>'no comment to this post',
                'status'=>404
            ]);
        }
        return response()->json([
            'data'=>$comment,
            'status'=>200
        ]);
    }
    public function Show_Comment($id)
    {
        $comment= Comments::where('post_id', '=', $id)->get();
        if(!$comment){
            return response()->json([
                'data'=>'no comment to this post',
                'status'=>404
            ]);
        }
        return response()->json([
            'data'=>$comment,
            'status'=>200
        ]);
    }


    public function Add_Comments(Request $request)
    {
        $auth_user = Auth::user()->id;
        $validate = Validator::make($request->all(), [
            'content' => 'required|string',
            'user_id' => 'required|integer',
            'post_id' => 'required|integer',
            'has_reply'=>'required'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }

        $comment =Comments::create([
            'content' => $request->content,
            'user_id' => $auth_user,
            'post_id' => $request->post_id,
            'has_reply'=>$request->has_reply,
        ]);

        if (!$comment) {
            return response()->json([
                "message" => "not comment",
                "status" => 406,
            ]);
        }

        return response()->json([
            "message" => "post commented",
            "status" => 201,
        ]);
    }



    public function delete_comment($id)
    {
        $comment=Comments::find($id);
        if (!$comment) {
            return response()->json([
                "message" => "comment not found",
                "status" => 404,
            ]);
        }
        
        $comment->delete();

        return response()->json([
            "message" => "comment deleted",
            "status" => 201,
        ]);
    }


}
