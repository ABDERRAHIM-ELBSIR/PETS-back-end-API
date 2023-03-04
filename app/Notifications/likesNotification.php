<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class likesNotification extends Notification
{
    use Queueable;
private $likes;
public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($like,$user)
    {
        $this->likes=$like;
        $this->user=$user;
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
            'name_of_user_liked'=>$this->user->name,
            'profile_img'=>$this->user->profile_img,
            'user_id'=>$this->user->id,
            'post_id'=>$this->likes->post_id,
            'message'=>'liked your post'
        ];
    }
}
