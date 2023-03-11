<?php

namespace App\Notifications;

use App\Models\Groups;
use App\Traits\user_Trait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GroupNotification extends Notification
{
    use Queueable;
    use user_Trait;
    private $posts;
    private $user_create_post;
    private $group_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($posts ,$user_create_post,$group_id)
    {
        $this->posts = $posts;
        $this->user_create_post=$user_create_post;
        $this->group_id=$group_id;

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
        list($name, $profile) = $this->get_user_info($this->user_create_post);
        $group_name=Groups::find($this->group_id)->name;
        return [
            'user' => [
                "name" => $name,
                "profile" => $profile,
            ],
            'post_description' => $this->posts->description,
            "group_name"=>$group_name,
        ];
    }
}