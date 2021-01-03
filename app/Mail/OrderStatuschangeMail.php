<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatuschangeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderStatus;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $orderStatus = $this->orderStatus['status'];
        $first_name = $this->orderStatus['first_name'];
        $orderNumber = $this->orderStatus['order_number'];
        //dd($this->orderStatus);
        return $this->markdown('emails.orderstatuschangemail')->with('orderData' , $this->orderStatus);
    }
}
