<?php

namespace App\Livewire\Pages;

use App\Services\Miscellaneous\DashboardService;
use Livewire\{Attributes\Layout, Attributes\Title, Component};

#[Title('Dashboard')]
#[Layout('layouts.personal-pages', ['padding' => '1rem', 'important' => '!important'])]
class Dashboard extends Component
{
    public function render(DashboardService $dashboardService)
    {
        return view('livewire.pages.dashboard', $dashboardService->getDashboardData());
    }
}
