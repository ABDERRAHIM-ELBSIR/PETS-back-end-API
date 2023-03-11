<?php

namespace App\Notifications;

use App\Traits\user_Trait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
{
    use Queueable;
    use user_Trait;
    private $auth_user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auth_user )
    {
        $this->auth_user=  $auth_user;
 
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
        list($name,$profile)=$this->get_user_info($this->auth_user);
        return [
            'user_name'=>$name,
            'user_img'=>$profile,
            'message'=>'send message',
        ];
    }
}
