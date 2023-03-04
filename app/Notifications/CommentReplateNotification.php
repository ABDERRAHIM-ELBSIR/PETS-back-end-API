<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentReplateNotification extends Notification
{
    use Queueable;
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
        return [
            'user_create_comment'=>$this->user_create_comment->name,
            'user_comment_img'=>$this->user_create_comment->profile_img,
            'comment_post_id' => $this->comment->comment_id,
            'message'=>'commented in your post',
        ];
    }
}