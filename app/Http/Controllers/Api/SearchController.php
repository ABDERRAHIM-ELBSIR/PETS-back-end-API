<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Groups;
use App\Traits\imgTrait;
use App\Traits\user_Trait;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    use imgTrait;
    use user_Trait;
    public function search(Request $request)
    {
        $result_of_user = [];
        $result_of_group = [];
        if (!$request->type) {
            $users = User::where('name','LIKE','%'.$request->name.'%')->get();
            $groups = Groups::where('name','LIKE','%'.$request->name.'%')->get();
            foreach ($users as $user) {
                list($name,$profile)=$this->get_user_info($user->id);
                $user_funded = [
                    "user_name" => $name,
                    "user_img" => $profile,
                ];
                array_push($result_of_user, $user_funded);
            }
            foreach ($groups as $group) {
                $group_founded = [
                    "group_name" => $group->name,
                    "group_img" => $this->get_file_path($group->profile_img),
                ];
                array_push($result_of_group, $group_founded);
            }
            if (!$result_of_user | !$result_of_group) {
                return response()->json([
                    "message" => "sumtgn whorn ",
                    "status" => 400
                ]);
            }
            return response()->json(
                [
                    "users" => $result_of_user,
                    "groups" => $result_of_group,
                    "status" => 200
                ]
            );
        }

        $groups = Groups::where('name','LIKE','%'.$request->name.'%')->get();
        foreach ($groups as $group) {
            $result = [
                "group_name" => $group->name,
                "group_img" =>$this->get_file_path($group->profile_img),
            ];
            array_push($result_of_group, $result);
        }
        if (!$result) {
            return response()->json([
                "message" => "group not found ",
                "status" => 404
            ]);
        }
        return response()->json(
            [
                "groups" => $result_of_group
            ]
        );


    }

}