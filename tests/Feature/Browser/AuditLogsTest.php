<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('verifies the audit logs page loads for an admin', function () {
    $admin = User::factory()->administrator()->active()->create();

    $this->browse(function (Browser $browser) use ($admin) {
        $browser->loginAs($admin)->visit('/audit-logs')->waitForText('Audit Logs', 10)->assertSee('Audit Logs');
    });
});
