<?php

use App\Models\User;
use App\Enums\PersonType;
use Laravel\Dusk\Browser;

it('renders the dashboard', function () {
    $user = User::factory()->create();
    $user->person->update(['type' => PersonType::Administrator]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user)
            ->visitRoute('dashboard.index')
            ->waitForText('Dashboard')
            ->assertSee('Dashboard');
    });
});
