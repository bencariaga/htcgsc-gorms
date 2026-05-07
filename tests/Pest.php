<?php

use App\{Enums\PersonType, Models\User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\{DuskTestCase, TestCase};

uses(TestCase::class, RefreshDatabase::class)->in('Feature/Logic');
uses(DuskTestCase::class)->group('browser')->in('Feature/Browser');

expect()->extend('toBeOne', fn () => $this->toBe(1));

function actingAsAdmin()
{
    return test()->actingAs(User::whereHas('person', function ($query) {
        $query->where('type', PersonType::Administrator);
    })->first());
}
