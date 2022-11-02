<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    public $to;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $to, $name)
    {
        //
        $this->data = $data;
        $this->to = $to;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('balebom@gmail.com', 'Thông báo về đơn hàng được đặt của bạn')
        ->to($this->to, $this->name)
        ->subject($this->data['subject'])
        ->view('emails.index')
        ->with('data', $this->data);
    }
}
