<?php

use App\Models\{Report, User};
use Laravel\Dusk\Browser;

it('can generate and delete reports', function () {
    $admin = User::whereHas('person', fn($q) => $q->where('type', 'Administrator'))->first();

    $this->browse(function (Browser $browser) use ($admin) {
        $browser->loginAs($admin)
            ->visit('/reports')
            ->assertSee('Generate Report')
            ->type('title', 'Test Report')
            ->type('start_date', '2026-01-01')
            ->type('end_date', '2026-12-31')
            ->click('button:contains("Select Category")')
            ->waitForText('Users', 10)
            ->click('button:contains("Users")')
            ->click('span:contains("PDF Document")')
            ->click('button:contains("Generate")')
            ->waitForText('Report has been generated successfully', 10)
            ->assertSee('Test Report');

        expect(Report::where('title', 'Test Report')->exists())->toBeTrue();

        $browser->click('button[title="Delete"]')
            ->waitForText('Deleting report', 10)
            ->click('#confirmationModal button:contains("Confirm")')
            ->waitForText('report has been deleted successfully', 10)
            ->assertDontSee('Test Report');

        expect(Report::where('title', 'Test Report')->exists())->toBeFalse();
    });
});
