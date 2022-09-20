<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message_barangay_mail extends Mailable
{
    use Queueable, SerializesModels;
    public $barangay_name,$message;
    /**
     * Create a new barangay_name,$message instance.
     *
     * @return void
     */
    public function __construct($barangay_name,$message)
    {
        $this->barangay_name = $barangay_name;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('message_barangay_mail');
    }
}
