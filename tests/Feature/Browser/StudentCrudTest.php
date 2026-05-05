<?php

use App\Models\{Student, User};
use Laravel\Dusk\Browser;

it('can list students and update profile', function () {
    $admin = User::whereHas('person', fn($q) => $q->where('type', 'Administrator'))->first();
    $student = Student::first();

    $this->browse(function (Browser $browser) use ($admin, $student) {
        $browser->loginAs($admin)
            ->visit('/students')
            ->assertSee('Students')
            ->assertSee($student->person->first_name)
            ->assertSee($student->person->last_name);

        $browser->click('button:contains("Edit")')
            ->waitForText('User Profile', 10)
            ->type('first_name', 'UpdatedName')
            ->click('button:contains("Save Changes")')
            ->waitForText('profile has been updated successfully', 10)
            ->assertSee('UpdatedName');
    });
});
