<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class newOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $orderData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notifydata)
    {
        //
        $this->orderData = $notifydata;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $orderId = $this->orderData['order_number'];
        //dd($orderId);
        $url = route('admin.orders.show', $orderId);
        return (new MailMessage)
                    ->line('An order has been placed with order id '.$orderId)
                    ->action('Click her to view ', $url)
                    ->line('Please consider to take action!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'order_id' => $this->orderData['order_number'],
            'first_name' => $this->orderData['first_name'],
            'email' => $this->orderData['email'],
            'type' => 'New Order',
        ];
    }
}
