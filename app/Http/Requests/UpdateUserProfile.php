<?php

namespace App\Http\Requests;

use App\{Enums\PersonSuffix, Models\User, Support\Regex};
use App\Rules\{DuplicateContactDetails, EmailAddressFormat};
use Illuminate\{Foundation\Http\FormRequest, Support\Facades\Auth, Support\Str, Validation\Rule};

class UpdateUserProfile extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $routeUser = $this->route('user');

        $targetUser = match (true) {
            $routeUser instanceof User => $routeUser,
            Str::of($routeUser)->isMatch(Regex::userName()) => User::find($routeUser),
            default => Auth::user(),
        };

        $personId = $targetUser->person?->person_id;

        return [
            'first_name' => ['required', 'string', 'max:20', 'regex:' . Regex::firstName()],
            'last_name' => ['required', 'string', 'max:20'],
            'middle_name' => ['nullable', 'string', 'max:20'],
            'suffix' => ['nullable', 'string', Rule::in(PersonSuffix::values())],
            'email_address' => ['required', 'email', 'max:60', new DuplicateContactDetails('email_address', $personId, 'user'), new EmailAddressFormat],
            'phone_number' => ['nullable', 'string', 'max:16', new DuplicateContactDetails('phone_number', $personId, 'user')],
            'profile_picture' => ['nullable', 'image', 'max:8192'],
        ];
    }
}
