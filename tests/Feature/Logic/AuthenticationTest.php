<?php

use App\Livewire\Authentication\Login;
use App\Models\{Person, User};
use Livewire\Livewire;

use function PHPUnit\Framework\assertFalse;

it('renders the login page', function () {
    $this->get(route('login'))->assertOk();
});

it('validates login input', function () {
    Livewire::test(Login::class)
        ->call('login')
        ->assertHasErrors(['email', 'password']);
});

it('redirects to otp-login after successful initial login', function () {
    $person = Person::factory()->create(['email_address' => 'test@example.com']);
    User::factory()->create(['person_id' => $person->person_id, 'password' => 'password123']);

    Livewire::test(Login::class)
        ->set('email', 'test@example.com')
        ->set('password', 'password123')
        ->call('login')
        ->assertRedirect(route('otp-login'));
});

it('fails login with invalid credentials', function () {
    $person = Person::factory()->create(['email_address' => 'test@example.com']);
    User::factory()->create(['person_id' => $person->person_id, 'password' => 'password123']);

    Livewire::test(Login::class)
        ->set('email', 'test@example.com')
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors(['email']);
});

it('can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('logout'))
        ->assertRedirect(route('login'));

    assertFalse(auth()->check());
});
