<?php

namespace App\Components\Molecules\Modals;

use App\Enums\{AppointmentTime, NonDB\PhilippineHolidays};
use Illuminate\View\Component;

class RescheduleAppointmentModal extends Component
{
    public array $holidayLookup;

    public string $timeZone;

    public int $totalSlots;

    public function __construct(public string $id)
    {
        $rawHolidays = PhilippineHolidays::all(now()->year);
        $this->holidayLookup = collect($rawHolidays)->flip()->all();
        $this->totalSlots = AppointmentTime::count();
        $this->timeZone = config('app.timezone') ?? 'UTC';
    }

    public function render()
    {
        return view('components.molecules.modals.reschedule-appointment-modal');
    }
}
