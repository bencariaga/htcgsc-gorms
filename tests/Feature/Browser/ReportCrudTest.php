<?php

use App\{Enums\PersonType, Models\User};
use Laravel\Dusk\Browser;

it('can generate and delete reports', function () {
    $admin = User::factory()->create();
    $admin->person->update(['type' => PersonType::Administrator]);

    $this->browse(function (Browser $browser) use ($admin) {
        $browser->loginAs($admin)
            ->visitRoute('reports.index')
            ->waitForText('Reports')
            ->type('title', 'Test Report')
            ->type('start_date', '2026-01-01')
            ->type('end_date', '2026-12-31')
            ->click('button.justify-between')
            ->waitForText('Appointment')
            ->click('button:contains("Appointment")')
            ->click('label:contains("PDF Document")')
            ->press('Save Report')
            ->waitForText('Report "Test Report" has been saved successfully!')
            ->click('[title="Delete report"]')
            ->waitForDialog()
            ->acceptDialog()
            ->waitForText('Report "Test Report" has been deleted successfully!');
    });
});
