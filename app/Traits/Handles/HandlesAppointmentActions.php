<?php

namespace App\Traits\Handles;

trait HandlesAppointmentActions
{
    public function complete($id)
    {
        $this->getService()->complete($id);

        $this->handlePostActionNotification('complete');
    }

    public function cancel($id)
    {
        $this->getService()->cancel($id);

        $this->handlePostActionNotification('cancel');
    }

    public function rescheduleAppointment($id, $date, $time)
    {
        $this->getService()->reschedule($id, $date, $time);

        $this->handlePostActionNotification('reschedule');

        $this->dispatch('refreshList');
    }
}
