<?php

use App\{Enums\AccountStatus, Models\User};
use Laravel\Dusk\Browser;

it('can list, deactivate, and delete users', function () {
    $admin = User::whereHas('person', fn ($q) => $q->where('type', 'Administrator'))->first();
    $user = User::whereHas('person', fn ($q) => $q->where('type', '!=', 'Administrator'))->where('account_status', AccountStatus::Active)->first();

    $this->browse(function (Browser $browser) use ($admin, $user) {
        $browser->loginAs($admin)
            ->visit('/users')
            ->waitForText('Users', 10)
            ->type('input[placeholder="Search..."]', $user->person->first_name)
            ->waitUntilMissingText('Loading...')
            ->waitForText($user->person->first_name, 10)
            ->assertSee($user->person->last_name);

        $browser->scrollTo('button:contains("Deactivate")')
            ->waitForText('Deactivate', 10)
            ->pause(100)
            ->press('Deactivate')
            ->waitForText('Deactivating', 10)
            ->pause(100)
            ->with('#confirmationModal', function ($modal) {
                $modal->press('Confirm');
            })
            ->waitForText('User account has been deactivated successfully.', 10)
            ->assertSee('Activate');

        $browser->waitForText('Delete', 10)
            ->pause(100)
            ->press('Delete')
            ->waitForText('Deleting', 10)
            ->pause(100)
            ->with('#confirmationModal', function ($modal) {
                $modal->press('Confirm');
            })
            ->waitForText('User account has been deleted successfully.', 10)
            ->assertDontSee($user->person->first_name);
    });
});
