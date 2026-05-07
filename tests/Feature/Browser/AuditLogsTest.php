<?php

use App\{Enums\PersonType, Models\User};
use Laravel\Dusk\Browser;

it('can view audit logs', function () {
    $admin = User::factory()->create();
    $admin->person->update(['type' => PersonType::Administrator]);

    $this->browse(function (Browser $browser) use ($admin) {
        $browser->loginAs($admin)
            ->visitRoute('audit-logs.index')
            ->waitForText('Audit Logs')
            ->assertSee('Audit Logs');
    });
});
