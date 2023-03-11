<?php

namespace App\Notifications;

use App\Traits\user_Trait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentReplateNotification extends Notification
{
    use Queueable;
    use user_Trait;

    private $comment_replate;
    private $user_create_comment_replate;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment_replate, $user_create_comment_replate)
    {
        $this->comment_replate = $comment_replate;
        $this->user_create_comment_replate =  $user_create_comment_replate;

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
        list($user_name, $user_img, $user_id) = $this->get_user_info($this->user_create_comment_replate);
        return [
            "user" => [       
                'id' => $user_id,
                'name' => $user_name,
                'img' => $user_img,
            ],
            'comment_id' => $this->comment_replate->id,
            'message'=>'replate to your comment',
        ];
    }
}