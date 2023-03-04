<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Groups;

use App\Models\Files;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    //create a group with user
    public function create_group(Request $request)
    {

        // check if user uploaded a profile image  
        $profile_img = $request->file('profile_img');
        $profile_img_data = null;
        if ($profile_img != null) {
            $image_path = $profile_img->store('images/group/profiles', 'chat_imgs');
            $data = Files::create([
                "type" => "image/png",
                "size" => 20025,
                //change name to refer_to id 
                'name' => 'default',
                //add type of refer_to  
                "file" => "storage/" . $image_path
            ]);
            $profile_img_data = $data;
        }
        // check if user uploaded a cover image  
        $cover_img = $request->file('cover_img');
        $cover_img_data = null;
        if ($cover_img != null) {
            // $image_path = $cover_img->store('images/group/covers', 'public');
            $image_path = $cover_img->store('images/group/covers', 'chat_imgs');
            $data = Files::create([
                "type" => "image/png",
                "size" => 20025,
                //change name to refer_to id 
                'name' => 'default',
                //add type of refer_to  
                "file" => "storage/" . $image_path
            ]);
            $cover_img_data = $data;
        }
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson(), 400);
        }
        //check id profile and cover if null
        $profile_img_id = null;
        $cover_img_id = null;
        if ($profile_img_data != null) {
            $profile_img_id = $profile_img_data->id;
        }
        if ($cover_img_data != null) {
            $cover_img_id = $cover_img_data->id;
        }
        $groups = Groups::create([
            'name' => $request->name,
            'profile_img' => $profile_img_id,
            'cover_img' => $cover_img_id,
            'description' => $request->description,
        ]);

        if (!$groups) {
            return response()->json([
                "message" => "groupe not created",
                "status" => 406,
            ]);
        }

        return response()->json([
            'data' => $groups,
            "message" => "message created",
            "status" => 200,
        ]);
    }



    public function delete_group($id)
    { //find group you whant deleted

        $group = Groups::find($id);

        if (!$group) {
            return response()->json([
                "message" => "group not found",
                "status" => 404,
            ]);
        }
        $group->delete();

        return response()->json([
            "message" => "group deleted",
            "status" => 201,
        ]);
    }

}