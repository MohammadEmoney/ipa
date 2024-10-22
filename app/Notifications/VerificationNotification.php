<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Services\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSms(object $notifiable): SmsMessage
    {
        $username = $notifiable->first_name ?: 'کاربر';
        $code = $notifiable->otp_code;

        $params = [
            [
                'name' => 'username',
                'value' => "$username",
            ],
            [
                'name' => 'verification-code',
                'value' => "$code",
            ],
        ];

        return (new SmsMessage)
                    ->to($notifiable->phone)
                    ->templateId('198103')
                    ->parameters($params)
                    ->line("These aren't the droids you are looking for.");
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
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
