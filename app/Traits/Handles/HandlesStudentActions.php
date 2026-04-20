<?php

namespace App\Traits\Handles;

trait HandlesStudentActions
{
    public function update($id, $formData = [])
    {
        $this->getService()->update($id, $formData);

        $this->handlePostActionNotification('update');
    }
}
