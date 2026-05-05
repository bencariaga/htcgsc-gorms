<?php

use App\Models\{Student, User};
use Facebook\WebDriver\WebDriverKeys;
use Laravel\Dusk\Browser;

it('can list students and update profile', function () {
    $admin = User::whereHas('person', fn ($q) => $q->where('type', 'Administrator'))->first();
    $student = Student::first();

    $this->browse(function (Browser $browser) use ($admin, $student) {
        $browser->loginAs($admin)
            ->visit('/students')
            ->waitForText('Students', 10)
            ->type('input[placeholder="Search..."]', $student->person->first_name)
            ->waitUntilMissingText('Loading...')
            ->waitForText($student->person->first_name, 10)
            ->assertSee($student->person->last_name);

        $browser->waitForText('Edit', 10)
            ->pause(100)
            ->press('Edit')
            ->waitForText('Student Profile Settings', 10)
            ->type('first_name', 'UpdatedName')
            ->pause(100)
            ->press('Save Changes')
            ->waitForText('Student profile has been updated successfully!', 10)
            ->keys('input[placeholder="Search..."]', WebDriverKeys::CONTROL, 'a', WebDriverKeys::BACKSPACE)
            ->pause(100)
            ->type('input[placeholder="Search..."]', 'UpdatedName')
            ->waitUntilMissingText('Loading...')
            ->waitForText('UpdatedName', 10);
    });
});
