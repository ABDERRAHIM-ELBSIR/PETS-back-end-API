<?php

namespace App\Http\Controllers;

use App\Notifications\MessageNotification;
use App\Traits\imgTrait;
use App\Traits\user_Trait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Validator;
use App\Models\Messages;
use App\Models\User;
use App\Models\Files;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    use imgTrait;
    use user_Trait;

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

        $data = [];
        foreach ($messages as $message) {
            $message_file = $this->get_file_path($message->file_id);
            list($user_name, $user_img) = $this->get_user_info($message->user_id); 

            $message_info = [
                "message"=>[
                    "content"=>$message->content,
                    "file"=>$message_file
                ],
                "user_info"=>[
                    "id"=>$message->user_id,
                    "name"=>$user_name,
                    "profile"=>$user_img
                ],
            ];
            array_push($data, $message_info);
        }

        return response()->json([
            'data'=>$data,
            'status' => 200
        ]);
    }



    //create new message for one or many users 
    public function store(Request $request)
    {


        $file_id = $request->file('file_id');
        $file_message_id = $this->upload_img($file_id, "message");
        // $file_id_data = null;
        // if ($file_id != null) {
        //     $image_path = $file_id->store('images/message', 'chat_imgs');
        //     $data = Files::create([
        //         "type" => "image/png",
        //         "size" => 20025,
        //         //change name to refer_to id 
        //         'name' => 'default',
        //         //add type of refer_to  
        //         "file" => "storage/" . $image_path
        //     ]);
        //     $file_id_data = $data;
        // }
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

        // if ($file_id_data != null) {
        //     $file_id_data = $file_id_data->id;
        // }
        $message = Messages::create([
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => $auth_user,
            'reciever_id' => $request->reciever_id,
            'file_id' => $file_message_id,
            'type' => $request->type,
        ]);

        if (!$message) {
            return response()->json([
                "message" => "not messages",
                "status" => 406,
            ]);
        }
        //sent notification 
        $reciever_id=User::find($request->reciever_id);
        Notification::send($reciever_id, new MessageNotification ($auth_user));

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