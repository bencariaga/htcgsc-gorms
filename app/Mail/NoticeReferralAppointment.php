<?php

namespace App\Mail;

use App\Models\{Appointment, Referral};
use App\Traits\Sets\SetsHighPriority;
use Illuminate\{Bus\Queueable, Contracts\Queue\ShouldQueue, Queue\SerializesModels};
use Illuminate\Mail\{Mailable, Mailables\Content, Mailables\Envelope};

class NoticeReferralAppointment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, SetsHighPriority;

    public function __construct(public Referral $referral, public Appointment $appointment, public string $reminderType) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: "Appointment Reminder: {$this->reminderType}", using: $this->highPriorityHeaders());
    }

    public function content(): Content
    {
        return new Content(view: 'emails.notice-referral-appointment', with: ['referral' => $this->referral, 'appointment' => $this->appointment, 'reminder' => $this->reminderType, 'date' => $this->appointment->appointment_date->format('F j, Y') . ' at ' . $this->appointment->appointment_time->value]);
    }
}
