<?php

namespace App\Http\Requests;

use App\{Rules\OneTimePassword, Support\Regex};
use Illuminate\Foundation\Http\FormRequest;

class SendOneTimePassword extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ['otp' => ['required', 'string', 'size:6', 'regex:' . Regex::otp(), new OneTimePassword]];
    }

    public function messages(): array
    {
        $otpRequired = 'Please enter the full 6-digit code.';
        $otpSize = 'The code must be exactly 6 digits.';
        $otpRegex = 'The code must only contain numbers.';

        return ['otp.required' => $otpRequired, 'otp.size' => $otpSize, 'otp.regex' => $otpRegex];
    }
}
