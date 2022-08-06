<?php

namespace App\Notifications\User;

use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Role;

class Welcome extends Notification
{
    use Queueable;

    public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data = array())
    {
        //
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
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $title = config('app.name');
        $site = Site::where('panelId',0)->first();
        if(!empty($site->title)):
            $title = $site->title;
        endif;

        return (new MailMessage)
                ->subject('Welcome to '.$title)
                ->line('Dear '.$this->data['name'])
                ->line('Thanks for signing up!')
                ->line('A welcome email is the first impression a company makes with a new customer, blog subscriber, or newsletter subscriber via email. Welcome emails can deliver videos, special offers, a sign-up form, or just a friendly hello to establish a relationship with a new contact.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $getGroup = Role::find($this->data['group']);
        $route = '/admin';

        if(!empty($getGroup) && $getGroup->name == 'Default'){
            $route = '/home';
        }
        return [
            'message' => 'Your account created',
            'icon'  => 'info',
            'url' => $route,
        ];
    }
}
