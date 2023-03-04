<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Messages;
use App\Models\Files;
use Illuminate\Http\Request;

class MessagesController extends Controller
{

    public function Show_message($id)
    { //show messages for user
        $user_auth = Auth::user()->id;
        $messages = Messages::
            where('user_id', '=', $user_auth)
            ->orWhere('reciever_id', '=', $id)
            ->get();

        if (!$messages) {
            return response()->json([
                'data' => 'no comment to this post',
                'status' => 404
            ]);
        }

        return response()->json([
            'data' => $messages,
            'status' => 200
        ]);
    }



    //create new message for one or many users 
    public function store(Request $request)
    {


        $file_id = $request->file('file_id');
        $file_id_data = null;
        if ($file_id != null) {
            $image_path = $file_id->store('images/message', 'chat_imgs');
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
            'content' => 'required|string',
            'status' => 'required',
            'user_id' => 'required|integer',
            'reciever_id' => 'required|integer',
            'file_id' => 'required',
            'type' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }

        if ($file_id_data != null) {
            $file_id_data = $file_id_data->id;
        }
        $message = Messages::create([
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => $auth_user,
            'reciever_id' => $request->reciever_id,
            'file_id' => $file_id_data,
            'type' => $request->type,
        ]);

        if (!$message) {
            return response()->json([
                "message" => "not messages",
                "status" => 406,
            ]);
        }
        
        return response()->json([
            'data' => $message,
            "message" => "message sent",
            "status" => 201,
        ]);
    }

    public function delete_message($id)
    { //delete messages
        $message = Messages::find($id);
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