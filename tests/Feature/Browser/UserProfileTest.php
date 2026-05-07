<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('verifies the user profile page loads', function () {
    $user = User::factory()->administrator()->active()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user)->visit('/user-profile')->waitForText('User Profile', 10)->assertSee('User Profile')->assertSee($user->person->first_name);
    });
});
