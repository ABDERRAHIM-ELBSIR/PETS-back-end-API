<?php

namespace App\Notifications;

use App\Traits\user_Trait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification
{
    use Queueable;
    use user_Trait;

    private $comment;
    private $user_create_comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment,$user_create_comment)
    {
        $this->comment = $comment;
        $this->user_create_comment = $user_create_comment;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        list($user_name, $user_img, $user_id) = $this->get_user_info( $this->user_create_comment);
        return [
            "user" => [       
                'id' => $user_id,
                'name' => $user_name,
                'img' => $user_img,
            ],
            'post_id' => $this->comment->post_id,
            'message'=>'commented in your post',
        ];
    }
}