<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Models\Circular;
use App\Models\Document;
use App\Models\Post;
use App\Services\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDocNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $document;

    /**
     * Create a new notification instance.
     */
    public function __construct($document)
    {
        $this->document;
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
        $doc = "";
        switch (get_class($this->document)) {
            case Circular::class:
                $doc = "بخشنامه";
                break;
            case Document::class:
                $doc = "سند";
                break;
            case Post::class:
                $doc = "اخبار";
                break;
            
            default:
                $doc = "اطلاعیه";
                break;
        }

        $params = [
            [
                'name' => 'username',
                'value' => "$username",
            ],
            [
                'name' => 'document',
                'value' => "$doc",
            ],
        ];

        return (new SmsMessage)
                    ->to($notifiable->phone)
                    ->templateId('856903')
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
