<?php

namespace App\Services\Miscellaneous;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\{Log, Session, Validator};

class OTPService
{
    protected MailService $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function generateAndSend(User $user, string $identifier, bool $isUpdate = false, bool $isResend = false): string
    {
        $otp_code = str(collect()->range(0, 999999)->random())->padLeft(6, '0')->toString();

        $otp_method = $this->sendOtp($user, $identifier, $otp_code, $isUpdate);

        $seconds = $isResend ? 180 : 181;

        $otp_expires_at = now()->addSeconds($seconds)->timestamp;

        Session::put(compact('otp_code', 'otp_expires_at', 'otp_method'));

        return $otp_method;
    }

    private function sendOtp(User $user, string $identifier, string $otp, bool $isUpdate): string
    {
        $isEmail = str($identifier)->contains('@');

        try {
            if ($isEmail && $this->isEmailValid($identifier)) {
                $this->sendEmailOtp($user, $identifier, $otp, $isUpdate);

                return 'email';
            }

            $context = $isUpdate ? 'phone number change' : 'login';
            $message = "Greetings, {$user->person->full_name}! Your OTP for this {$context} is: {$otp}. Valid for 180s.";
            app(TextBeeService::class)->sendSms([$identifier], $message);

            return 'sms';
        } catch (Exception $e) {
            Log::warning('OTP delivery failed via ' . ($isEmail ? 'Email' : 'SMS') . " for {$identifier}. Error: {$e->getMessage()}");

            if ($isEmail) {
                return $this->sendOtp($user, $user->person->phone_number, $otp, $isUpdate);
            }

            return $this->sendOtp($user, $user->person->email_address, $otp, $isUpdate);
        }
    }

    protected function sendEmailOtp(User $user, string $email, string $otp, bool $isUpdate): void
    {
        $isUpdate ? $this->mailService->sendEmailChangeOtp($user, $email, $otp) : $this->mailService->sendOtpLogin($user, $otp);
    }

    protected function isEmailValid(string $email): bool
    {
        return Validator::make(compact('email'), ['email' => ['required', 'email']])->passes();
    }

    public function validate(string $submittedOtp): string
    {
        if ($submittedOtp !== Session::get('otp_code')) {
            return 'invalid';
        }

        return now()->timestamp > Session::get('otp_expires_at') ? 'expired' : 'valid';
    }

    public function findUserByIdentifier(string $identifier): ?User
    {
        return User::whereRelation('person', fn ($q) => $q->whereAny(['email_address', 'phone_number'], $identifier))->first();
    }
}
