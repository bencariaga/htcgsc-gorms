<?php

namespace App\Livewire\Pages;

use App\{Actions\Appointment\UpdateNewDate, Data\AppointmentRescheduleData, Livewire\Bases\BaseListType};
use App\{Contracts\AppointmentServiceContract, Traits\Handles\HandlesAppointmentActions};
use Exception;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Throwable;

#[Title('Appointments')]
class Appointments extends BaseListType
{
    use HandlesAppointmentActions;

    public ?string $newDate = null;

    public ?string $newTime = null;

    public array $unavailableSlots = [];

    public mixed $editingAppointmentId = null;

    protected function defaultSortField(): string
    {
        return 'appointment_date';
    }

    public function updatedNewDate(?string $value, UpdateNewDate $action)
    {
        $this->newTime = null;
        $this->unavailableSlots = $action->handle($value);
    }

    public function rescheduleAppointment(int|string $appointmentId, AppointmentServiceContract $service): void
    {
        try {
            $this->editingAppointmentId = $appointmentId;
            $service->reschedule(new AppointmentRescheduleData(appointmentId: $this->editingAppointmentId, date: $this->newDate, time: $this->newTime));
            $this->handlePostActionNotification('reschedule');
            $this->dispatch('close-modal', id: 'rescheduleAppointmentModal');
            $this->reset(['newDate', 'newTime', 'editingAppointmentId', 'unavailableSlots']);
        } catch (ValidationException $e) {
            /** @var Throwable $e */
            throw $e;
        } catch (Exception $e) {
            session()->flash('error', "Something went wrong: {$e->getMessage()}");
        }
    }
}
