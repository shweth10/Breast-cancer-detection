<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PolicyExpiredNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $emailData;

    /**
     * Create a new message instance.
     *
     * @param  array  $emailData
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Policy Expired')
                    ->view('emails.policy_expired')
                    ->with('client', $this->emailData['client']);
    }
}