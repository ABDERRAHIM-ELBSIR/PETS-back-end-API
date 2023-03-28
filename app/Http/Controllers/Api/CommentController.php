<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;
use Validator;
use App\Models\Posts;
use App\Models\User;
use App\Notifications\CommentNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function Show_Num_Comment($id)
    {

        //get number of comment post have
        $count_comment = Comments::where('post_id', '=', $id)
            ->count();

        //if do not  fund comment
        if (!$count_comment) {
            return response()->json([
                'data' => 'no comment to this post',
                'status' => 404
            ]);
        }
        return response()->json([
            'data' => $count_comment,
            'status' => 200
        ]);
    }
    public function Show_Comment($id)
    {
        //show content of comment for post
        $comment = Comments::where('post_id', '=', $id)->get();

        //if do not have comment
        if (!$comment) {
            return response()->json([
                'data' => 'no comment to this post',
                'status' => 404
            ]);
        }
        //show comment in response
        return response()->json([
            'data' => $comment,
            'status' => 200
        ]);
    }
    public function SendNotification($post_id ,$comment)
    {
        $post=Posts::find($post_id);

        if (!$post) {
            return response()->json([
                'message' => 'post not found',
                'status' => 404,
            ]);
        }
        $user_create_comment=Auth::user()->id;
        $user_create_post=User::find($post->user_id);
        Notification::send($user_create_post, new CommentNotification($comment,$user_create_comment));
    }

    public function Add_Comments(Request $request)
    {
        $id=time();
        // check if user uploaded  image 
        $img = $request->file('img');
        $img_id = $this->upload_img($img, "comment",$id,"comment");
        //creator of comment 
        $auth_user = Auth::user()->id;

        //validate element
        $validate = Validator::make($request->all(), [
            'content' => 'required|string',
            'user_id' => 'required|integer',
            'post_id' => 'required|integer',
            'has_reply' => 'required',
        ]);
        //if validate fails
        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }
        //crete comment
        $comment = Comments::create([
            'id'=>$id,
            'content' => $request->content,
            'user_id' => $auth_user,
            'post_id' => $request->post_id,
            'has_reply' => $request->has_reply,
            'img'=>$img_id

        ]);
        //if comment das not create
        if (!$comment) {
            return response()->json([
                "message" => "post not comment",
                "status" => 406,
            ]);
        }
        //===============send notification if commented=========================
        $this->SendNotification($request->post_id,$comment);  
        //===============send notification if commented=========================

        return response()->json([
            "message" => "post commented",
            "status" => 201,
        ]);
    }



    public function delete_comment($id)
    {
        //find comment you whant deleted
        $comment = Comments::find($id);

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