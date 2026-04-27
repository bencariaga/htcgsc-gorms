<?php

namespace App\Traits\Concerns;

trait HandlesUsers
{
    public function activate(int|string $id): void
    {
        $this->getService()->activate($id);

        $this->handlePostActionNotification('activate');
    }

    public function deactivate(int|string $id): void
    {
        $this->getService()->deactivate($id);

        $this->handlePostActionNotification('deactivate');
    }

    public function update(int|string $id): void
    {
        $this->getService()->update($id);

        $this->handlePostActionNotification('update');
    }

    public function delete(int|string $id): void
    {
        $this->getService()->delete($id);

        $this->handlePostActionNotification('delete');
    }
}
