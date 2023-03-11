<?php

namespace App\Notifications;

use App\Traits\user_Trait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;
    use user_Trait;
    private $posts;
private $user_create_post;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($posts,$user_create_post)
    {
        $this->posts = $posts;
        $this->user_create_post = $user_create_post;

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
        List($user_name,$user_img)=$this->get_user_info($this->user_create_post);
        return [
            'user_create_post_name'=>$user_name,
            'user_create_post_img'=>$user_img,
            'message'=>'create a new post'
        ];
    }
}
