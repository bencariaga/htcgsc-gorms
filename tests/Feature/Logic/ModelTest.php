<?php

use App\Models\{Appointment, Person, Referral, Student, User};

it('tests user has a person relationship', function () {
    $user = User::factory()->create();
    expect($user->person)->toBeInstanceOf(Person::class);
});

it('tests student has a person relationship', function () {
    $student = Student::factory()->create();
    expect($student->person)->toBeInstanceOf(Person::class);
});

it('tests person can have a user', function () {
    $user = User::factory()->create();
    $person = $user->person;
    expect($person->user)->toBeInstanceOf(User::class);
});

it('tests appointment has relationships', function () {
    $appointment = Appointment::factory()->create();

    expect($appointment->person)->toBeInstanceOf(Person::class);
    expect($appointment->referral)->toBeInstanceOf(Referral::class);
    expect($appointment->student)->toBeInstanceOf(Student::class);
});
