<?php

namespace App\Notifications;

use App\Mail\Orders\NewOrderForCustomer;
use App\Services\Contracts\InvoicesServiceContract;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramFile;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NewOrderForCustomer
     */
    public function toMail($notifiable)
    {
        return (new NewOrderForCustomer($notifiable->id, $notifiable->user->name))->to($notifiable->user);
    }

    public function toTelegram($notifiable)
    {
        $invoiceService = app()->make(InvoicesServiceContract::class);
        $pdf = $invoiceService->generate($notifiable)->save('public');

        return TelegramFile::create()
            ->to($notifiable->user->telegram_id)
            ->content("Hello, your order #{$notifiable->id} was created")
            ->document($pdf->url(), $pdf->filename);
    }

}
