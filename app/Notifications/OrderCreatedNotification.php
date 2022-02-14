<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *  Available Channels: mail, database, broadcast, nexmo (sms), slack
     *
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $order = $this->order;
        $billing  = $this->order->addresses()->where('type', '=', 'billing')->first();
        $line1 = "{$billing->first_name} {$billing->last_name} has placed a new order(#{$order->number}) on store " . config('app.name') . ".";
        return (new MailMessage)
            // ->from('any thing I want')
            ->subject('New Order #' . $this->order->number)
            ->greeting("Hi {$notifiable->name}, ")
            ->line($line1)
            ->action('View Order ', url('/dashboard/orders/' . $order->id))
            ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable)
    {
        $order = $this->order;
        $billing  = $this->order->addresses()->where('type', '=', 'billing')->first();
        $line1 = "{$billing->first_name} {$billing->last_name} has placed a new order(#{$order->number}) on store " . config('app.name') . ".";
        $url = url('/dashboard/orders/' . $order->id);
        return [

            //  basic Notificaiton Data
            'title' =>  'New Order #' . $order->number,
            'body' => $line1,
            'image' => '',
            'url' => $url,
            // Custom Data
            'order' => $order
        ];
    }
    public function toBroadcast($notifiable){
        // Private Channel, Public Channel, Presence Channel
        $order = $this->order;
        $billing  = $this->order->addresses()->where('type', '=', 'billing')->first();
        $line1 = "{$billing->first_name} {$billing->last_name} has placed a new order(#{$order->number}) on store " . config('app.name') . ".";
        $url = url('/dashboard/orders/' . $order->id);
        return new BroadcastMessage([
            'title' =>  'New Order #' . $order->number,
            'body' => $line1,
            'image' => '',
            'url' => $url,
            // Custom Data
            'order' => $order
        ]);
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
        ];
    }
}
