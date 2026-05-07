<?php

use App\{Enums\PersonType, Models\Student, Models\User};
use Laravel\Dusk\Browser;

it('can list students and update profile', function () {
    $admin = User::factory()->create();
    $admin->person->update(['type' => PersonType::Administrator]);

    $student = Student::factory()->create();

    $this->browse(function (Browser $browser) use ($admin, $student) {
        $browser->loginAs($admin)
            ->visitRoute('students.index')
            ->waitForText($student->person->last_name)
            ->assertSee($student->person->last_name)
            ->press('Edit')
            ->waitForText('Student Profile Settings')
            ->type('first_name', 'UpdatedFirstName')
            ->press('Save Changes')
            ->waitForText('Student profile has been updated successfully!');
    });
});
