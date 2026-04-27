<?php

namespace App\Traits\Handles;


trait HandlesPostActionNotifications
{
    protected function handlePostActionNotification(string $action)
    {
        $type = $this->getType();
        $isUser = $type === 'user';
        $entity = str($type);

        $alertType = 'success';

        $entityLabel = $isUser ? 'User' : $entity->title()->toString();
        $noun = $isUser ? 'account' : 'record';

        $pastParticiple = match ($action) {
            'activate' => 'activated',
            'deactivate' => 'deactivated',
            'delete' => 'deleted',
            'update' => 'updated',
            'complete' => 'marked as done',
            'cancel' => 'cancelled',
            'reschedule' => 'rescheduled',
            default => "{$action}ed",
        };

        $this->dispatch('notify', type: $alertType, message: "{$entityLabel} {$noun} has been <strong>{$pastParticiple}</strong> successfully.");
        $this->dispatch('hide-loading-accounts');
    }
}
