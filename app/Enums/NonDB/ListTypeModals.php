<?php

namespace App\Enums\NonDB;

use Illuminate\Support\Facades\Blade;

enum ListTypeModals: string
{
    case STUDENT = 'student';
    case APPOINTMENT = 'appointment';
    case AUDIT_LOG = 'audit-log';

    public function renderModal(): string
    {
        return match ($this) {
            self::STUDENT => Blade::render('<x-molecules.forms.student-profile-form id="studentProfileModal" />'),
            self::APPOINTMENT => Blade::render('<x-molecules.modals.reschedule-appointment-modal id="rescheduleAppointmentModal" />'),
            self::AUDIT_LOG => Blade::render('<x-molecules.modals.audit-log-message-modal id="audit-log-modal" />'),
        };
    }
}
