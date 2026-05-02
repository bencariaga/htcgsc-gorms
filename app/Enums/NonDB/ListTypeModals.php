<?php

namespace App\Enums\NonDB;

use App\Traits\Has\HasValues;
use Illuminate\Support\Facades\Blade;

enum ListTypeModals: string
{
    use HasValues;

    case STUDENT = 'student';
    case USER = 'user';
    case APPOINTMENT = 'appointment';
    case AUDIT_LOG = 'audit-log';

    public function renderModal(): string
    {
        return match ($this) {
            self::STUDENT => Blade::render("@livewire('components.student-profile-modal')"),
            self::USER => Blade::render("@livewire('components.user-profile-modal')"),
            self::APPOINTMENT => Blade::render('<x-molecules.modals.reschedule-appointment-modal id="rescheduleAppointmentModal" />'),
            self::AUDIT_LOG => Blade::render('<x-molecules.modals.audit-log-message-modal id="audit-log-modal" />'),
        };
    }
}
