<?php

use App\Models\{Appointment, Person, Referral, Student, User};

it('tests user has a person relationship', function () {
    $person = Person::factory()->create();
    $user = User::factory()->create(['person_id' => $person->person_id]);

    expect($user->person)->toBeInstanceOf(Person::class);
    expect($user->person->person_id)->toBe($person->person_id);
});

it('tests student has a person relationship', function () {
    $person = Person::factory()->create();
    $student = Student::factory()->create(['person_id' => $person->person_id]);

    expect($student->person)->toBeInstanceOf(Person::class);
    expect($student->person->person_id)->toBe($person->person_id);
});

it('tests person can have a user', function () {
    $person = Person::factory()->create();
    $user = User::factory()->create(['person_id' => $person->person_id]);

    expect($person->user)->toBeInstanceOf(User::class);
    expect($person->user->user_id)->toBe($user->user_id);
});

it('tests appointment has relationships', function () {
    $appointment = Appointment::factory()->create();

    expect($appointment->referral)->toBeInstanceOf(Referral::class);
    expect($appointment->referral->student)->toBeInstanceOf(Student::class);
});
