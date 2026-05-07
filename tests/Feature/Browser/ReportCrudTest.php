<?php

use App\Models\{Report, User};
use Laravel\Dusk\Browser;

it('can generate and delete reports', function () {
    $admin = User::whereHas('person', fn ($q) => $q->where('type', 'Administrator'))->first();
    $reportTitle = 'Test Report ' . uniqid();

    $this->browse(function (Browser $browser) use ($admin, $reportTitle) {
        $browser->loginAs($admin)
            ->visit('/reports')
            ->waitForText('Generate Report', 10)
            ->type('input[name="title"]', $reportTitle)
            ->type('input[name="start_date"]', '2026-01-01')
            ->type('input[name="end_date"]', '2026-12-31');

        $browser->script("
            document.querySelectorAll('button[type=\"button\"]').forEach(b => { if(b.innerText.trim() === 'Users') b.click(); });
            document.querySelectorAll('label').forEach(l => { if(l.innerText.trim() === 'PDF Document') l.click(); });
        ");

        $browser->pause(100)
            ->press('Generate Report')
            ->waitForText('saved successfully', 10)
            ->assertSee($reportTitle);

        expect(Report::where('title', $reportTitle)->exists())->toBeTrue();

        $browser->pause(100)
            ->waitFor('p[title="' . $reportTitle . '"]', 5)
            ->script("document.querySelector('p[title=\"" . $reportTitle . "\"]').closest('button').querySelector('div[title=\"Delete report\"]').click();");

        $browser->acceptDialog()
            ->waitForText('deleted successfully', 10);

        expect(Report::where('title', $reportTitle)->exists())->toBeFalse();
    });
});
