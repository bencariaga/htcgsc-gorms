<?php

use App\Models\{Student, User};
use Laravel\Dusk\Browser;

it('can list students and update profile', function () {
    $admin = User::factory()->active()->administrator()->create();
    $student = Student::factory()->create();

    $this->browse(function (Browser $browser) use ($admin, $student) {
        $browser->loginAs($admin)
            ->visit('/students')
            ->assertSee('Students')
            ->assertSee($student->person->first_name)
            ->assertSee($student->person->last_name);

        $browser->click('button:contains("Edit")')
            ->waitForText('User Profile')
            ->type('first_name', 'UpdatedName')
            ->click('button:contains("Save Changes")')
            ->waitForText('profile has been updated successfully')
            ->assertSee('UpdatedName');
    });
});
