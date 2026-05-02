<?php

namespace App\Services\Miscellaneous;

use App\Actions\OTP\{FindUserByIdentifier, GenerateAndSendOTP, ValidateOTP};
use App\Models\User;

class OTPService
{
    public function __construct(protected GenerateAndSendOTP $generateAndSend, protected ValidateOTP $validateOtp, protected FindUserByIdentifier $findUser) {}

    public function generateAndSend(User $user, string $identifier, bool $isUpdate = false, bool $isResend = false): string
    {
        return $this->generateAndSend->handle($user, $identifier, $isUpdate, $isResend);
    }

    public function validate(string $submittedOtp): string
    {
        return $this->validateOtp->handle($submittedOtp);
    }

    public function findUserByIdentifier(string $identifier): ?User
    {
        return $this->findUser->handle($identifier);
    }
}
