<?php

namespace App\Traits\Handles;

trait HandlesUserActions
{
    public function activate($id)
    {
        $this->getService()->activate($id);

        $this->handlePostActionNotification('activate');
    }

    public function deactivate($id)
    {
        $this->getService()->deactivate($id);

        $this->handlePostActionNotification('deactivate');
    }

    public function update($id)
    {
        $this->getService()->update($id);

        $this->handlePostActionNotification('update');
    }

    public function delete($id)
    {
        $this->getService()->delete($id);

        $this->handlePostActionNotification('delete');
    }
}
