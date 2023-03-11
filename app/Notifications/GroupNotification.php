<?php

namespace App\Notifications;

use App\Models\Groups;
use App\Traits\imgTrait;
use App\Traits\user_Trait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GroupNotification extends Notification
{
    use Queueable;
    use user_Trait;
    use imgTrait;
    private $posts;
    private $user_create_post;
    private $group_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($posts, $user_create_post, $group_id)
    {
        $this->posts = $posts;
        $this->user_create_post = $user_create_post;
        $this->group_id = $group_id;

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
        list($name, $profile, $user_id) = $this->get_user_info($this->user_create_post);
        $group = Groups::find($this->group_id);
        $file=$this->get_file_path($group->profile);
        return [
            'user' => [
                'id' => $user_id,
                "name" => $name,
                "profile" => $profile,
            ],
            'group' => [
                "id" => $group->id,
                "name" => $group->name,
                "profile"=>$file,
            ],
            'post_id' => $this->posts->id,
            "message" => "posted"
        ];
    }
}