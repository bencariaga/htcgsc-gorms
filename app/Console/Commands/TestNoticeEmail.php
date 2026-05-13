<?php

namespace App\Console\Commands;

use App\{Mail\NoticeReferralAppointment, Models\Referral};
use Exception;
use Illuminate\Support\Facades\Mail;

class TestNoticeEmail extends BaseCommand
{
    protected $signature = 'mail:test-notice {email}';

    public function handle()
    {
        if ($this->call('internet:check') !== 0) {
            return 1;
        }

        $email = $this->argument('email');
        $referral = Referral::with(['student.person'])->first();

        if (!$referral) {
            $this->components->error('No referral found in the database.');

            return 1;
        }

        $appointment = $referral->appointment;

        if (!$appointment) {
            $this->components->error('The first referral does not have an appointment.');

            return 1;
        }

        $this->components->info("Sending test email to {$email}...");

        try {
            Mail::to($email)->send(new NoticeReferralAppointment($referral, $appointment, '12 hours'));
            $this->components->info('Email sent successfully!');
        } catch (Exception $e) {
            $this->components->error("Failed to send email: {$e->getMessage()}");

            return 1;
        }

        return 0;
    }
}
