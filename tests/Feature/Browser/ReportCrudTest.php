<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('can generate and delete reports', function () {
    $admin = User::factory()->active()->administrator()->create();

    $this->browse(function (Browser $browser) use ($admin) {
        $browser->loginAs($admin)
            ->visit('/reports')
            ->assertSee('Generate Report')
            ->type('title', 'Test Report')
            ->type('start_date', '2026-01-01')
            ->type('end_date', '2026-12-31')
            ->click('button:contains("Select Category")')
            ->waitForText('Users')
            ->click('button:contains("Users")')
            ->click('span:contains("PDF Document")')
            ->click('button:contains("Generate")')
            ->waitForText('Report has been generated successfully')
            ->assertSee('Test Report');

        $browser->click('button[title="Delete"]')
            ->waitForText('Deleting report')
            ->click('#confirmationModal button:contains("Confirm")')
            ->waitForText('report has been deleted successfully')
            ->assertDontSee('Test Report');
    });
});
