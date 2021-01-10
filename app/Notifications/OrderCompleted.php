<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompleted extends Notification
{
    use Queueable;

    public $notificationData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationData)
    {
        $this->notificationData = $notificationData;
        //dd($notificationData);
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
        $orderId = $this->notificationData['order_number'];
        $orderUser = $this->notificationData['first_name'];
        $orderEmail = $this->notificationData['email'];
        $orderStatus = $this->notificationData['status'];
        //dd($orderId);
        $url = route('admin.orders.show', $orderId);
        return (new MailMessage)
                    ->line('The following order from '.$orderUser)
                    ->line('is now '.$orderStatus)
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
            'order_id' => $this->notificationData['order_number'],
            'first_name' => $this->notificationData['first_name'],
            'email' => $this->notificationData['email'],
            'status' => $this->notificationData['status'],
            'type' => 'Completed Order',
        ];
    }
}
