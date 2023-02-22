<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\comments_replies;
use Validator;
use Illuminate\Http\Request;

class CommentReplateController extends Controller
{
    public function Show_Comment_Rep($id)
    {
        $comment= comments_replies::where('comment_id', '=', $id);
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
    public function Show_Number_Of_Comment($id)
    {
        $comment= comments_replies::where('comment_id', '=', $id)
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


    public function Add_Comment_Rep(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'content' => 'required|string',
            'comment_id' => 'required|integer',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }

        $comment =comments_replies::create([
            'content' => $request->content,
            'comment_id' => $request->comment_id,
        ]);

        if (!$comment) {
            return response()->json([
                "message" => "no comment replated",
                "status" => 406,
            ]);
        }

        return response()->json([
            "message" => "post comments",
            "status" => 201,
        ]);
    }



    public function delete_Comment_Rep($id)
    {
        $comment=comments_replies::find($id);
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
