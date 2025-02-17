<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\comments_replies;
use Validator;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentReplateNotification;
use Illuminate\Http\Request;

class CommentReplateController extends Controller
{
    public function Show_Comment_Rep($id)
    { //get comment replate do you have
        $comment = comments_replies::where('comment_id', '=', $id)->get();
        //if das not fund comment
        if (!$comment) {
            return response()->json([
                'data' => 'no comment to this post',
                'status' => 404
            ]);
        }
        //if fund comment show him in response 
        return response()->json([
            'data' => $comment,
            'status' => 200
        ]);
    }
    public function Show_Number_Of_Comment($id)
    {
        //count of comment do you have
        $comment = comments_replies::where('comment_id', '=', $id)
            ->count();
        //if do not  have comment
        if (!$comment) {
            return response()->json([
                'data' => 'no comment to this post',
                'status' => 404
            ]);
        }
        //if fund comment show him in response 

        return response()->json([
            'data' => $comment,
            'status' => 200
        ]);
    }

    public function SendNotification($comment_id ,$comment_replate)
    {
        $comment = Comments::find($comment_id);

        if (!$comment) {
            return response()->json([
                'message' => 'post not found',
                'status' => 404,
            ]);
        }
        $user_create_comment_replate = Auth::user()->id;
        $user_create_post = User::find($comment->user_id);
        Notification::send($user_create_post, new CommentReplateNotification($comment_replate, $user_create_comment_replate));
    }

    public function Add_Comment_Rep(Request $request)
    {
        $id=time();
        // check if user uploaded  image 
        $img = $request->file('img');
        $img_id = $this->upload_img($img, "comment",$id,"comment");
        //validate info add comment
        $validate = Validator::make($request->all(), [
            'content' => 'required|string',
            'comment_id' => 'required|integer',
        ]);
        //if validate fails
        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }
        //create comment replate
        $comment_replate = comments_replies::create([
            'id'=>$id,
            'content' => $request->content,
            'comment_id' => $request->comment_id,
            'img'=>$img_id ,
        ]);
        //comment replated not creted
        if (!$comment_replate) {
            return response()->json([
                "message" => "comment not  replated",
                "status" => 406,
            ]);
        }
        //===============send notification if commented========================
        $this->SendNotification($request->comment_id ,$comment_replate);
        //===============send notification if commented=========================
        //show comment in response if have it
        return response()->json([
            "message" => "post comments",
            "status" => 201,
        ]);
    }



    public function delete_Comment_Rep($id)
    {
        //delete comment if fund it
        $comment = comments_replies::find($id);

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