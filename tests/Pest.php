<?php

use App\{Enums\PersonType, Models\User};
use Tests\{DuskTestCase, TestCase};

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "extends()" function bound to specific directories.
|
*/

uses(TestCase::class)->in('Feature/NotBrowser');

uses(DuskTestCase::class)->in('Feature/Browser');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "matchers" that help you make assertions.
|
*/

expect()->extend('toBeOne', fn () => $this->toBe(1));

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you reduce code duplication.
|
*/

function actingAsAdmin()
{
    return test()->actingAs(User::whereHas('person', function ($query) {
        $query->where('type', PersonType::Administrator);
    })->first());
}
