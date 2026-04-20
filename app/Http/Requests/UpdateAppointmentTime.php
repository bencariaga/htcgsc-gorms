<?php

namespace App\Http\Requests;

use App\Rules\AppointmentScheduler;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentTime extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date', new AppointmentScheduler($this->input('time'))],
            'time' => ['required', 'string'],
        ];
    }
}
