<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('verifies the submissions page loads for an admin', function () {
    $admin = User::factory()->administrator()->active()->create();

    $this->browse(function (Browser $browser) use ($admin) {
        $browser->loginAs($admin)->visit('/submissions')->waitForText('Submissions', 10)->assertSee('Submissions');
    });
});
