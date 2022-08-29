<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Approved_complains_respondent extends Mailable
{
    use Queueable, SerializesModels;
    public $respondent_first_name, $respondent_middle_name, $respondent_last_name,$complainant_first_name, $complainant_middle_name, $complainant_last_name,$hearing_date,$hearing_time,$barangay;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($respondent_first_name, $respondent_middle_name, $respondent_last_name,$complainant_first_name, $complainant_middle_name, $complainant_last_name,$hearing_date,$hearing_time,$barangay)
    {
        $this->respondent_first_name = $respondent_first_name;
        $this->respondent_middle_name = $respondent_middle_name;
        $this->respondent_last_name = $respondent_last_name;
        $this->complainant_first_name = $complainant_first_name;
        $this->complainant_middle_name = $complainant_middle_name;
        $this->complainant_last_name = $complainant_last_name;
        $this->hearing_date = $hearing_date;
        $this->hearing_time = $hearing_time;
        $this->barangay = $barangay;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('approved_complains_respondent');
    }
}
