<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('can update user profile and password', function () {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user)
            ->visitRoute('user-profile.index', ['user' => $user->user_id])
            ->waitForText('User Profile Settings')
            ->type('first_name', 'UpdatedFirstName')
            ->press('Save Changes')
            ->waitForText('User profile has been updated successfully!')
            ->press('Change Password')
            ->waitForText('Change Password')
            ->type('current_password', 'password')
            ->type('new_password', 'newpassword123')
            ->type('new_password_confirmation', 'newpassword123')
            ->press('Confirm')
            ->waitForText('Password has been updated successfully!');
    });
});
