<?php

namespace App\Notifications;

use App\Traits\user_Trait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class likesNotification extends Notification
{
    use Queueable;
    use user_Trait;
    private $likes;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($like, $user)
    {
        $this->likes = $like;
        $this->user = $user;
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
        list($user_name, $user_img, $user_id) = $this->get_user_info($this->user->id);
        return [
            "user" => [       
                'id' => $user_id,
                'name' => $user_name,
                'img' => $user_img,
            ],
            'post_id' => $this->likes->post_id,
            'message' => 'liked your post'
        ];
    }
}