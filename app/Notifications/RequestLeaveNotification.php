<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Leave;

class RequestLeaveNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $leave;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Leave $leave)
    {
        $this->user = $user;
        $this->leave = $leave;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'sender_id' => $this->user->id,
            'sender_name' => $this->user->full_name,
            'route' => '/read/manage/request/leave',
            'message' => $this->user->full_name.' has been request '.strtolower($this->leave->leave_type).' leave.',
        ];
    }
}
