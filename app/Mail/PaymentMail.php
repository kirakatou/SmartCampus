<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $no, $name, $event_name, $price, $valid_date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($no, $name, $event_name, $price, $valid_date)
    {
        $this->no = $no;
        $this->name = $name;
        $this->event_name = $event_name;
        $this->price = $price;
        $this->valid_date = $valid_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Invoice for ' . $this->event_name . ' Event')
                    ->from('smartcampus@hmjsi.org')
                    ->view('emails.payment');
    }
}
