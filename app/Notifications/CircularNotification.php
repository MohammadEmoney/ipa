<?php

namespace App\Notifications;

use App\Models\Circular;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CircularNotification extends Notification
{
    use Queueable;

    public $circular;

    /**
     * Create a new notification instance.
     */
    public function __construct(Circular $circular)
    {
        $this->circular = $circular;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('New Circular uploaded.')
                    ->action('See Circular', route('user.circulars.show', ['circular' => $this->circular->slug]))
                    ->line('Thank you for using Iranian Pilot Association Application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->circular->id,
            'title' => $this->circular->title,
            'slug' => $this->circular->slug,
        ];
    }
}
