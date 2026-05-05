<?php

use App\Models\{Appointment, User};
use Laravel\Dusk\Browser;

it('can list, complete, and cancel appointments', function () {
    $admin = User::factory()->administrator()->active()->create();
    $appointment = Appointment::factory()->create([
        'appointment_status' => 'Scheduled',
        'appointment_date' => now()->format('Y-m-d'),
        'reason' => 'UNIQUE_REASON_FOR_TEST'
    ]);

    $this->browse(function (Browser $browser) use ($admin, $appointment) {
        $studentLastName = $appointment->referral->student->person->last_name;

        $browser->loginAs($admin)
            ->visit('/appointments')
            ->assertSee('Appointments')
            ->waitFor('input[placeholder="Search..."]')
            ->type('input[placeholder="Search..."]', $studentLastName)
            ->waitUntilMissingText('Loading...')
            ->waitForText($studentLastName, 10)
            ->type('input[placeholder="Search..."]', $appointment->reason)
            ->waitUntilMissingText('Loading...')
            ->waitForText($appointment->reason, 10);

        $browser->waitForText('Mark as Done', 10)
            ->pause(100)
            ->press('Mark as Done')
            ->waitForText('Marking appointment as \'done\'', 10)
            ->pause(100)
            ->with('#confirmationModal', function ($modal) {
                $modal->press('Confirm');
            })
            ->waitForText('Appointment record has been marked as done successfully.', 10)
            ->assertSee('Done');

        $appointment2 = Appointment::factory()->create(['appointment_status' => 'Scheduled']);

        $browser->visit('/appointments')
            ->waitForText($appointment2->referral->student->person->first_name, 10)
            ->waitForText('Cancel', 10)
            ->pause(100)
            ->press('Cancel')
            ->waitForText('Cancelling appointment', 10)
            ->pause(100)
            ->with('#confirmationModal', function ($modal) {
                $modal->press('Confirm');
            })
            ->waitForText('Appointment record has been cancelled successfully.', 10)
            ->assertSee('Cancelled');
    });
});
