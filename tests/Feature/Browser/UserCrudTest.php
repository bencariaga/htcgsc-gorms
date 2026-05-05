<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('can list, deactivate, and delete users', function () {
    $admin = User::factory()->active()->administrator()->create();
    $user = User::factory()->active()->create();

    $this->browse(function (Browser $browser) use ($admin, $user) {
        $browser->loginAs($admin)
            ->visit('/users')
            ->assertSee('Users')
            ->assertSee($user->person->first_name)
            ->assertSee($user->person->last_name);

        $browser->click('button:contains("Deactivate")')
            ->waitForText('Deactivating', 10)
            ->click('#confirmationModal button:contains("Confirm")')
            ->waitForText('user account has been deactivated successfully', 10)
            ->assertSee('Activate');

        $browser->click('button:contains("Delete")')
            ->waitForText('Deleting', 10)
            ->click('#confirmationModal button:contains("Confirm")')
            ->waitForText('user account has been deleted successfully', 10)
            ->assertDontSee($user->person->first_name);
    });
});
