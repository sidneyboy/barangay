<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Disapproved extends Mailable
{
    use Queueable, SerializesModels;
    public $first_name,$middle_name,$last_name,$assistance_title,$approved_cash,$barangay,$reason;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name,$middle_name,$last_name,$assistance_title,$approved_cash,$barangay,$reason)
    {
        $this->first_name = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        $this->assistance_title = $assistance_title;
        $this->approved_cash = $approved_cash;
        $this->barangay = $barangay;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('disapproved');
    }
}
