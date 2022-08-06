<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Account extends Notification
{
    use Queueable;
    public $account;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($account = array())
    {
        //account details;
        $this->data = $account;
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
        
        return (new MailMessage)
                    ->subject('Request for bank account adding')
                    ->line('Dear '.$this->data['account_name'])
                    ->line('Youre account has been successfully added with us! please check your account details carefully.')
                    ->line('Bank Name : '.$this->data['bank_name'])
                    ->line('Branch    : '.$this->data['branch'])
                    ->line('A/C No    : '.$this->data['account_no'])
                    ->line('IFSC Code : '.$this->data['ifsc'])
                    ->line('A welcome email is the first impression a company makes with a new customer, blog subscriber, or newsletter subscriber via email.')
                    ->line('If you did not request a account adding, Please Report us.');
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
            'message' => 'Added a new bank account in ('.$this->data['bank_name'].')',
            'icon'  => 'target',
            'url' => '/home/account',
        ];
    }
}
