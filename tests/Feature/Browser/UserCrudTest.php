<?php

use App\{Enums\AccountStatus, Enums\PersonType, Models\User};
use Laravel\Dusk\Browser;

it('can list, deactivate, and delete users', function () {
    $admin = User::factory()->create();
    $admin->person->update(['type' => PersonType::Administrator]);

    $user = User::factory()->create(['account_status' => AccountStatus::Active]);

    $this->browse(function (Browser $browser) use ($admin, $user) {
        $browser->loginAs($admin)
            ->visitRoute('users.index')
            ->waitForText($user->username)
            ->assertSee($user->username)
            ->press('Deactivate')
            ->waitForText('Are you sure you want to deactivate')
            ->press('Confirm')
            ->waitForText('User account has been deactivated successfully!')
            ->press('Delete')
            ->waitForText('Are you sure you want to delete')
            ->press('Confirm')
            ->waitForText('User account has been deleted successfully!');
    });
});
