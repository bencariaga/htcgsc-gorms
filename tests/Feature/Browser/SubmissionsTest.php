<?php

use App\{Enums\PersonType, Models\User};
use Laravel\Dusk\Browser;

it('can view submissions', function () {
    $admin = User::factory()->create();
    $admin->person->update(['type' => PersonType::Administrator]);

    $this->browse(function (Browser $browser) use ($admin) {
        $browser->loginAs($admin)
            ->visitRoute('submissions.index')
            ->waitForText('Submissions')
            ->assertSee('Submissions');
    });
});
