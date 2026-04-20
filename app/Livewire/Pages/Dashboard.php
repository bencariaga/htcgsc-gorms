<?php

namespace App\Livewire\Pages;

use App\Services\Miscellaneous\DashboardService;
use Livewire\{Attributes\Layout, Attributes\Title, Component};

class Dashboard extends Component
{
    #[Layout('layouts.personal-pages')]
    #[Title('Dashboard')]
    public function render(DashboardService $dashboardService)
    {
        return view('livewire.pages.dashboard', $dashboardService->getDashboardData());
    }
}
