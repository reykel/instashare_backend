<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManagerNotifications extends Mailable
{
    use Queueable, SerializesModels;

    public $_subject;
    public $_body;
    public $_footer;
    public $url;
    public $slot;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_subject, $_body, $url, $name, $slot, $_footer)
    {
        $this->_subject = $_subject;
        $this->_body = $_body;
        $this->_footer = $_footer;
        $this->slot = $slot;
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email')->subject($this->_subject);
    }
}
