<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('verifies the dashboard loads for an admin', function () {
    $admin = User::factory()->administrator()->active()->create();

    $this->browse(function (Browser $browser) use ($admin) {
        $browser->loginAs($admin)->visit('/dashboard')->waitForText('Dashboard', 10)->assertSee('Dashboard')->assertSee($admin->person->first_name);
    });
});
