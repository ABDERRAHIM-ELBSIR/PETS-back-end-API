<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Groups;
// use App\Models\Posts;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $result_of_user = [];
        $result_of_group = [];
        if (!$request->type) {
            $users = User::all();
            $groups = Groups::all();
            foreach ($users as $user) {
                $user_funded = [
                        "user_name" => $user->name,
                        "user_img" => $user->profile_img,
                ];
                array_push($result_of_user, $user_funded);
            }
            foreach ($groups as $group) {
                $group_founded = [
                        "group_name" => $group->name,
                        "group_img" => $group->profile_img,
                ];
                array_push($result_of_group, $group_founded);
            }
            return response()->json(
                [
                    "users"=>$result_of_user,
                    "groups"=>$result_of_group
                    
                ]
            );

        } else {
            $groups = Groups::all();
            foreach ($groups as $group) {
                $result = [
                        "group_name" => $group->name,
                        "group_img" => $group->profile_img,
                ];
                array_push($result_of_group, $result);
            }
            return response()->json(
                [
                    "groups"=>$result_of_group
                ]
            );
        }
       
    }

}