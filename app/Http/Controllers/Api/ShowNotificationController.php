<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

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
                        "user" => [
                            'id' => $notification->data['user']->id,
                            'name' => $notification->data['user']->name,
                            'img' => $notification->data['user']->img,
                        ],
                        'description' => $notification->data['post_id'],
                        'message' => $notification->data['message'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;

                case 'App\Notifications\likesNotification':
                    $notifications = [
                        "user" => [
                            'id' => $notification->data['user']->id,
                            'name' => $notification->data['user']->name,
                            'img' => $notification->data['user']->img,
                        ],
                        'content' => $notification->data['message'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;
                case 'App\Notifications\CommentNotification':
                    $notifications = [
                        "user" => [
                            'id' => $notification->data['user']->id,
                            'name' => $notification->data['user']->name,
                            'img' => $notification->data['user']->img,
                        ],

                        'post_id' => $notification->data['post_id'],
                        'content' => $notification->data['message'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;
                case 'App\Notifications\CommentReplateNotification':
                    $notifications = [
                        "user" => [
                            'id' => $notification->data['user']->id,
                            'name' => $notification->data['user']->name,
                            'img' => $notification->data['user']->img,
                        ],
                        'comment_id' => $notification->data['comment_id'],
                        'message' => $notification->data['message'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;
                case 'App\Notifications\MessageNotification':
                    $notifications = [
                        "user" => [
                            'id' => $notification->data['user']->id,
                            'name' => $notification->data['user']->name,
                            'img' => $notification->data['user']->img,
                        ],

                        'message' => $notification->data['message'],
                        'status' => 200,
                    ];
                    array_push($all_notification, $notifications);
                    break;
                case 'App\Notifications\GroupNotification':
                    $notifications = [
                        "user" => [
                            'id' => $notification->data['user']->id,
                            'name' => $notification->data['user']->name,
                            'img' => $notification->data['user']->img,
                        ],
                        "group" => [
                            'id' => $notification->data['group']->id,
                            'name' => $notification->data['group']->name,
                            'img' => $notification->data['group']->img,
                        ],
                        'post_id'=>$notification->data['post_id'],
                        'message' => $notification->data['message'],
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