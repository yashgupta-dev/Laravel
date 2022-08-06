<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Other extends Notification
{
    use Queueable;

    public $message;
    public $icon;
    public $url;
    public $mail;
    public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message,$icon,$url,$mail=false,$data=[])
    {
        //
        $this->message = $message;
        $this->icon = $icon;
        $this->url = $url;
        $this->mail = $mail;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->mail) {
            return (new MailMessage)
                ->subject($this->data['subject'])
                ->line('Dear '.$this->data['name'])
                ->line($this->data['message']);
        }
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
            'message' => $this->message,
            'icon'  => $this->icon,
            'url' => $this->url,
        ];
    }
}
