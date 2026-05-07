<?php

use App\Enums\{AppointmentStatus, PersonType};
use App\Models\{Appointment, User};
use Laravel\Dusk\Browser;

it('can list and reschedule appointments', function () {
    $admin = User::factory()->create();
    $admin->person->update(['type' => PersonType::Administrator]);

    $appointment = Appointment::factory()->create([
        'appointment_status' => AppointmentStatus::Scheduled,
        'appointment_date' => now()->addDay()->format('Y-m-d'),
    ]);

    $this->browse(function (Browser $browser) use ($admin, $appointment) {
        $browser->loginAs($admin)
            ->visitRoute('appointments.index')
            ->waitForText($appointment->formatted_appointment_id)
            ->assertSee($appointment->formatted_appointment_id)
            ->click('.group.relative.cursor-pointer')
            ->waitForText('Rescheduling Appointment')
            ->type('input[type="date"]', now()->addDays(2)->format('Y-m-d'))
            ->pause(1000)
            ->press('Reschedule')
            ->waitForText('Appointment has been rescheduled successfully!');
    });
});
