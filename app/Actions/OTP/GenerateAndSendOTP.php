<?php

namespace App\Actions\OTP;

use App\Models\User;
use App\Services\Miscellaneous\{MailService, TextBeeService};
use Exception;
use Illuminate\Support\Facades\{Log, Session, Validator};

class GenerateAndSendOTP
{
    public function __construct(protected MailService $mailService) {}

    public function handle(User $user, string $identifier, bool $isUpdate = false, bool $isResend = false): string
    {
        $otp_code = str(collect(range(0, 999999))->random())->padLeft(6, '0')->toString();

        $otp_method = $this->sendOtp($user, $identifier, $otp_code, $isUpdate);

        $seconds = $isResend ? 180 : 181;

        $otp_expires_at = now()->addSeconds($seconds)->timestamp;

        Session::put(compact('otp_code', 'otp_expires_at', 'otp_method'));

        return $otp_method;
    }

    private function sendOtp(User $user, string $identifier, string $otp, bool $isUpdate, bool $isRetry = false): string
    {
        $isEmail = str($identifier)->contains('@');

        try {
            if ($isEmail && $this->isEmailValid($identifier)) {
                $isUpdate ? $this->mailService->sendEmailChangeOtp($user, $identifier, $otp) : $this->mailService->sendOtpLogin($user, $otp);
                Log::info("OTP email sent successfully to: {$identifier}");

                return 'email';
            }

            $context = $isUpdate ? 'phone number change' : 'login';

            $message = "Greetings, {$user->person->full_name}! Your OTP for this {$context} is: {$otp}. Valid for 180s.";

            app(TextBeeService::class)->sendSms([$identifier], $message);

            Log::info("OTP SMS sent successfully to: {$identifier}");

            return 'sms';
        } catch (Exception $e) {
            Log::warning('OTP delivery failed via ' . ($isEmail ? 'Email' : 'SMS') . " for {$identifier}. Error: {$e->getMessage()}");

            if ($isRetry) {
                throw $e;
            }

            $fallbackIdentifier = $isEmail ? $user->person->phone_number : $user->person->email_address;

            if (!$fallbackIdentifier || $fallbackIdentifier === $identifier) {
                throw $e;
            }

            Log::info("Attempting OTP delivery to fallback identifier: {$fallbackIdentifier}");

            return $this->sendOtp($user, $fallbackIdentifier, $otp, $isUpdate, true);
        }
    }

    protected function isEmailValid(string $email): bool
    {
        return Validator::make(compact('email'), ['email' => ['required', 'email']])->passes();
    }
}
