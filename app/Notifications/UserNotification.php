<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Services\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification ///implements ShouldQueue
{
    use Queueable;

    public $sendVia;
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $sendVia, string $message)
    {
        $this->sendVia = $sendVia;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $via = array_map(function($item) {
            return $item === 'sms' ? SmsChannel::class : $item;
        }, $this->sendVia);
        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSms(object $notifiable): SmsMessage
    {
        dd('sms');
        $username = $notifiable->first_name ?: 'کاربر';

        $params = [
            [
                'name' => 'username',
                'value' => "$username",
            ],
            [
                'name' => 'hour',
                'value' => "72",
            ],
        ];

        return (new SmsMessage)
                    ->to($notifiable->phone)
                    ->templateId('631816')
                    ->parameters($params)
                    ->line("These aren't the droids you are looking for.");
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    // ->subject($this->subject)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
