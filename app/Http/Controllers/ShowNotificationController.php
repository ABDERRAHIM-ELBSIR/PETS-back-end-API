<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShowNotificationController extends Controller
{
    public function ShowNotification()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $all_notification = [];

        //switch for all notification and filter him about type of this notification (group|post|likes...)
        foreach ($user->notifications as $notification) {
            switch ($notification->type) {
                case 'App\Notifications\PostNotification':
                    $notifications = [
                        'user_crete_post_name' => $user->name,
                        'user_crete_id' => $user->id,
                        'user_crete_post_img' => $user->profile_img,
                        'description' => $notification->data['post_description'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;

                case 'App\Notifications\likesNotification':
                    $notifications = [
                        'user_liked_post_name' =>$notification->data['name_of_user_liked'],
                        'user_liked_post_img' => $notification->data['profile_img'],
                        'user_crete_id' =>$notification->data['user_id'],
                        'content' => $notification->data['message'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;
                case 'App\Notifications\CommentNotification':
                    $notifications = [
                        'user_create_comment' =>$notification->data['user_create_comment'],
                        'user_comment_img' => $notification->data['user_comment_img'],
                        'comment_post_id' =>$notification->data['comment_post_id'],
                        'content' => $notification->data['message'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;
                case 'App\Notifications\MessageNotification':
                    $notifications = [
                        'user_name' =>$notification->data['user_create_comment'],
                        'user_img' => $notification->data['user_comment_img'],
                        'content' => $notification->data['message'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;
            }
        }
        if (!$all_notification) {
            return response()->json([
                'message' => 'notification not fund',
                'status' => 404
            ]);
        }
        return response()->json([
            'notification' => $all_notification,
            'message' => 'notification for this user',
            'status' => 200
        ]);

    }
}