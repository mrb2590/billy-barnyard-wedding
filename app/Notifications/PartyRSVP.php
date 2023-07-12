<?php

namespace App\Notifications;

use App\Models\Guest;
use App\Models\Party;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PartyRSVP extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The notification subject.
     */
    protected string $subject;

    /**
     * The notification message.
     */
    protected array $message = [];

    /**
     * The party that RSVP'd.
     */
    protected Party $party;

    /**
     * Create a new notification instance.
     */
    public function __construct(Party $party)
    {
        $this->party = $party;
        $this->subject = 'The party ' . $party->name . ' has RSVP\'d';

        $this->party->guests()->each(function (Guest $guest) {
            array_push(
                $this->message,
                $guest->name . ' ' . ($guest->is_attending ? 'will attend' : 'will not attend') . ' the party.'
            );

            if ($guest->has_rehearsal_invite) {
                array_push(
                    $this->message,
                    $guest->name .
                        ' ' .
                        ($guest->is_attending_rehearsal ? 'will attend' : 'will not attend') .
                        ' the welcome dinner.'
                );
            }
        });
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
        $mail = (new MailMessage())->subject($this->subject);

        foreach ($this->message as $message) {
            $mail->line($message);
        }

        $mail->action('View Party', url('/admin/parties/' . $this->party->id))->line('We are getting married!');

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'party' => $this->party,
            'subject' => $this->subject,
            'message' => $this->message
        ];
    }
}
