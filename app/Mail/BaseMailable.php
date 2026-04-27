<?php

namespace App\Mail;

use App\{Models\User, Traits\Sets\SetsHighPriority};
use Illuminate\{Bus\Queueable, Contracts\Queue\ShouldQueue};
use Illuminate\Mail\{Mailable, Mailables\Content, Mailables\Envelope};

abstract class BaseMailable extends Mailable implements ShouldQueue
{
    use Queueable, SetsHighPriority;

    protected string $subjectText;

    protected string $viewName;

    public User $user;

    public ?string $otp;

    public function __construct(User $user, ?string $otp = null)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->defineMailableConfig();
    }

    abstract protected function defineMailableConfig(): void;

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->subjectText, using: $this->highPriorityHeaders());
    }

    public function content(): Content
    {
        return new Content(view: $this->viewName, with: ['user' => $this->user, 'otp' => $this->otp]);
    }
}
