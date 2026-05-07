<?php

use App\{Livewire\Authentication\Login, Models\Person, Models\User};
use Livewire\Livewire;

it('renders the login page', function () {
    $this->get(route('login'))->assertStatus(200)->assertSee('Login');
});

it('validates login input', function () {
    Livewire::test(Login::class)->set('email', '')->set('password', '')->call('login')->assertHasErrors(['email', 'password']);
});

it('redirects to otp-login after successful initial login', function () {
    $person = Person::factory()->create();
    $user = User::factory()->create(['person_id' => $person->person_id, 'password' => bcrypt('password123')]);
    Livewire::test(Login::class)->set('email', $person->email_address)->set('password', 'password123')->call('login')->assertRedirect(route('otp-login'));
});

it('fails login with invalid credentials', function () {
    $person = Person::factory()->create();
    $user = User::factory()->create(['person_id' => $person->person_id, 'password' => bcrypt('password123')]);
    Livewire::test(Login::class)->set('email', $user->username)->set('password', 'wrong-password')->call('login')->assertHasErrors(['email']);
});

it('can logout', function () {
    $user = User::factory()->create();
    $user->setAttribute('remember_token', null);
    $this->actingAs($user)->post(route('logout'))->assertRedirect('/');
    $this->assertGuest();
});
