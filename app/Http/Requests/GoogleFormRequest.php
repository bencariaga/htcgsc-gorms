<?php

namespace App\Http\Requests;

use App\Enums\{AppointmentTime, ReferralType};
use Illuminate\{Contracts\Validation\Validator, Foundation\Http\FormRequest, Http\Exceptions\HttpResponseException, Validation\Rules\Enum};

class GoogleFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'referral_type' => $this->input('REFERRAL TYPE (if Yourself, copy your information above to the next page)'),
            'reason' => $this->input('State the reason for seeking an appointment'),
            'appointment_date' => $this->input('APPOINTMENT DATE (between Monday and Friday only)'),
            'appointment_time' => $this->input('APPOINTMENT TIME'),
        ]);
    }

    public function rules(): array
    {
        return [
            'Last Name (Referrer)' => ['required', 'string', 'max:20'],
            'First Name (Referrer)' => ['required', 'string', 'max:20'],
            'Middle Name (Referrer)' => ['nullable', 'string', 'max:20'],
            'School Email Address (Referrer)' => ['required', 'email', 'max:60'],
            'Phone Number (Referrer)' => ['required', 'string', 'max:11'],
            'referral_type' => ['required', new Enum(ReferralType::class)],
            'Last Name (Referral)' => ['required', 'string', 'max:20'],
            'First Name (Referral)' => ['required', 'string', 'max:20'],
            'Middle Name (Referral)' => ['nullable', 'string', 'max:20'],
            'School Email Address (Referral)' => ['required', 'email', 'max:60'],
            'Phone Number (Referral)' => ['required', 'string', 'max:11'],
            'reason' => ['required', 'string', 'max:255'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required', new Enum(AppointmentTime::class)],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $success = false;
        $errors = $validator->errors();

        /** @var mixed $exception */
        $exception = new HttpResponseException(response()->json(compact('success', 'errors'), 422));

        throw $exception;
    }
}
