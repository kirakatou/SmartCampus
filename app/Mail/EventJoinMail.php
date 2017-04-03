<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventJoinMail extends Mailable
{
    use Queueable, SerializesModels;
    public $event_name, $price, $datetime, $location, $qr;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event_name, $price, $datetime, $location, $qr)
    {
        $this->event_name = $event_name;
        $this->price = $price;
        $this->datetime = $datetime;
        $this->location = $location;
        $this->qr = $qr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thanks for your participation!')
                    ->from('smartcampus@hmjsi.org')
                    ->view('emails.join');
    }
}
