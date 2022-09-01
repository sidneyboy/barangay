<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Document_approved_request extends Mailable
{
    use Queueable, SerializesModels;
    public $first_name, $middle_name, $last_name, $document_name, $document_amount,$barangay;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name, $middle_name, $last_name, $document_name, $document_amount,$barangay)
    {
        $this->first_name = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        $this->document_name = $document_name;
        $this->document_amount = $document_amount;
        $this->barangay = $barangay;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('document_approved_request_email');
    }
}
