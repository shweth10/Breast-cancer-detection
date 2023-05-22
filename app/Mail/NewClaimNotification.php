<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewClaimNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
{
    return $this->subject('New Claim Submitted')
                ->view('emails.new_claim')
                ->with('claim', $this->emailData['claim']);
}
protected $emailData;

public function __construct($emailData)
{
    $this->emailData = $emailData;
}

}
