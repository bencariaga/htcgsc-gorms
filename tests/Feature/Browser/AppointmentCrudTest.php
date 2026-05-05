<?php

use App\Models\{Appointment, User};
use Laravel\Dusk\Browser;

it('can list, complete, and cancel appointments', function () {
    $admin = User::whereHas('person', fn($q) => $q->where('type', 'Administrator'))->first();
    $appointment = Appointment::first();
    $appointment->update(['appointment_status' => 'Scheduled']);

    $this->browse(function (Browser $browser) use ($admin, $appointment) {
        $browser->loginAs($admin)
            ->visit('/appointments')
            ->assertSee('Appointments')
            ->assertSee($appointment->referral->student->person->first_name);

        $browser->click('button:contains("Mark as Done")')
            ->waitForText('Marking appointment as \'done\'', 10)
            ->click('#confirmationModal button:contains("Confirm")')
            ->waitForText('appointment as \'done\' has been mark as done successfully', 10)
            ->assertSee('Done');

        $appointment2 = Appointment::skip(1)->first();
        $appointment2->update(['appointment_status' => 'Scheduled']);
        $browser->refresh()
            ->waitForText($appointment2->referral->student->person->first_name, 10)
            ->click('button:contains("Cancel")')
            ->waitForText('Cancelling appointment', 10)
            ->click('#confirmationModal button:contains("Confirm")')
            ->waitForText('appointment has been cancel successfully', 10)
            ->assertSee('Cancelled');
    });
});
