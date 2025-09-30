<?php

namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Book $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Booking Confirmation')
                    ->view('emails.user_confirmation');
    }
}
