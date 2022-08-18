<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class send_email_to_resident extends Mailable
{
    use Queueable, SerializesModels;

    public $email,$password,$first_name,$last_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$password,$first_name,$last_name)
    {
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('barangay_information@gmail.com')->markdown('send_email_to_resident');
    }
}
