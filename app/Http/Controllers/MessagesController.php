<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{

    public function Show_message($id)
    {
        $user_auth=Auth::user()->id;
        $messages= Messages::where('user_id', '=', $user_auth)
        ->orWhere('reciever_id', '=', $id)
        ->get();
        if(!$messages){
            return response()->json([
                'data'=>'no comment to this post',
                'status'=>404
            ]);
        }
        return response()->json([
            'data'=>$messages,
            'status'=>200
        ]);
    }



    public function store(Request $request)
    {
        $auth_user = Auth::user()->id;
        $validate = Validator::make($request->all(), [
            'content' => 'required|string',
            'status' => 'required',
            'user_id' => 'required|integer',
            'reciever_id' => 'required|integer',
            'file_id'=>'required',
            'type'=>'required'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }

        $message =Messages::create([
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => $auth_user,
            'reciever_id' => $request->reciever_id,
            'file_id'=>$request->file_id,
            'type'=>$request->file_id,
        ]);

        if (!$message) {
            return response()->json([
                "message" => "not messages",
                "status" => 406,
            ]);
        }

        return response()->json([
            'data'=>$message,
            "message" => "message sent",
            "status" => 201,
        ]);
    }

    public function delete_message($id)
    {
        $message=Messages::find($id);
        if (!$message) {
            return response()->json([
                "message" => "message not found",
                "status" => 404,
            ]);
        }
        
        $message->delete();

        return response()->json([
            "message" => "message deleted",
            "status" => 201,
        ]);
    }
}
