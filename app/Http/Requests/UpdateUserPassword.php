<?php

namespace App\Http\Requests;

use App\Rules\{MatchesCurrentFullName, UserPassword};
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPassword extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(?string $identifier = null): array
    {
        return [
            'identifier' => ['required'],
            'full_name' => ['required', new MatchesCurrentFullName($identifier)],
            'newPassword' => ['required', 'min:8', 'confirmed', new UserPassword($identifier)],
        ];
    }
}
