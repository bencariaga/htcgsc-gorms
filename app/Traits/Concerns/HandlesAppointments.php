<?php

namespace App\Traits\Concerns;

trait HandlesAppointments
{
    public function complete(int|string $id): void
    {
        $this->getService()->complete($id);

        $this->handlePostActionNotification('complete');
    }

    public function cancel(int|string $id): void
    {
        $this->getService()->cancel($id);

        $this->handlePostActionNotification('cancel');
    }

    public function rescheduleAppointment(int|string $id, ?string $date, ?string $time): void
    {
        $this->getService()->reschedule($id, $date, $time);

        $this->handlePostActionNotification('reschedule');

        $this->dispatch('refreshList');
    }
}
