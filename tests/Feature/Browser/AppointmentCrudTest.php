<?php

use App\Models\{Appointment, User};
use Laravel\Dusk\Browser;

it('can list, complete, and cancel appointments', function () {
    $admin = User::factory()->active()->administrator()->create();
    $appointment = Appointment::factory()->create(['appointment_status' => 'Scheduled']);

    $this->browse(function (Browser $browser) use ($admin, $appointment) {
        $browser->loginAs($admin)
            ->visit('/appointments')
            ->assertSee('Appointments')
            ->assertSee($appointment->referral->student->person->first_name);

        $browser->click('button:contains("Mark as Done")')
            ->waitForText('Marking appointment as \'done\'')
            ->click('#confirmationModal button:contains("Confirm")')
            ->waitForText('appointment as \'done\' has been mark as done successfully')
            ->assertSee('Done');

        $appointment2 = Appointment::factory()->create(['appointment_status' => 'Scheduled']);
        $browser->refresh()
            ->waitForText($appointment2->referral->student->person->first_name)
            ->click('button:contains("Cancel")')
            ->waitForText('Cancelling appointment')
            ->click('#confirmationModal button:contains("Confirm")')
            ->waitForText('appointment has been cancel successfully')
            ->assertSee('Cancelled');
    });
});
