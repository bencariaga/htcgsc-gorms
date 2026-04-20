<?php

namespace App\Data;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class UserRegistrationData extends Data
{
    public function __construct(public string $firstName, public string $lastName, public ?string $middleName, public ?string $suffix, public string $email, public ?string $phoneNumber, public string $password, public ?UploadedFile $profilePicture) {}
}
