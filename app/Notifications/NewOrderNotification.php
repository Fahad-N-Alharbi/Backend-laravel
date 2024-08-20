<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail']; 
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('طلب جديد')
                    ->line('تم تقديم طلب جديد من قبل المستخدم : ' . $this->order->user->name)
                    ->line('معرف الطلب : ' . $this->order->id)
                    ->action('عرض الطلب', url('/admin/orders/' . $this->order->id))
                    ->line('شكرا لك على استخدام التطبيق لدينا');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'user_name' => $this->order->user->name,
        ];
    }
}
