<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AceptacionNotifications extends Mailable
{
    use Queueable, SerializesModels;

    public $_subject;
    public $_body;
    public $_footer;
    public $_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_subject, $_body, $_footer, $_id)
    {
        $this->_subject = $_subject;
        $this->_body = $_body;
        $this->_footer = $_footer;
        $this->_id = $_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('aceptacion')->subject($this->_subject);
    }
}
