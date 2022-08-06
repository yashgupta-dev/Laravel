<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Address extends Notification
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
        return ['mail','database',];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   
        $out = '';
        $land = '';
        $cisty = '';
        if(!empty($this->data['address_line'])) {
            $out.=$this->data['address_line'].', ';
        }
        if(!empty($this->data['address_line_two'])) {
            $out.=$this->data['address_line_two'].', ';
        }
        if(!empty($this->data['country'])) {
            $cisty.=$this->data['country'].', ';
        }
        if(!empty($this->data['state'])) {
            $cisty.=$this->data['state'].', ';
        }
        if(!empty($this->data['city'])) {
            $cisty.=$this->data['city'].' - ';
        }
        if(!empty($this->data['postal_code'])) {
            $cisty.=$this->data['postal_code'];
        }
        if(!empty($this->data['mark'])) {
            $land.=' Land Mark: '.$this->data['mark'];
        }
        return (new MailMessage)
                    ->subject('Request for address adding')
                    ->line('Youre address has been successfully added with us! please check your address details carefully.')
                    ->line('Your Address : ')
                    ->line($out)
                    ->line($cisty)
                    ->line($land)
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
        $out = '';
        if(!empty($this->data['address_line'])) {
            $out.=$this->data['address_line'].', ';
        }
        if(!empty($this->data['address_line_two'])) {
            $out.=$this->data['address_line_two'].', ';
        }
        
        return [
            'message' => 'Added a '.$out.' new address',
            'icon'  => 'home',
            'url' => '/home/address',
        ];
    }
}
