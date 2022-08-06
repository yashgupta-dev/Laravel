<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class User extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = array())
    {
        //
        $this->data = $data;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $mail = $this->view('mails.user',compact('data'))->subject($this->data['subject']);
        if(!empty($this->data['attachments'])) {
            foreach($this->data['attachments'] as $file) {
                $mail->attach(storage_path('app/'.$file['attachments']));
            }
        }

        return $mail;
    }
}
