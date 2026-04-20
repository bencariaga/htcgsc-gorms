<?php

namespace App\Enums\NonDB;

enum EmailNotice: string
{
    case ACTIVATION = 'activation';
    case DEACTIVATION = 'deactivation';
    case DELETION = 'deletion';

    public function getConfig(): array
    {
        $base = 'Your account has been';
        $byTheAdmin = 'by the HTCGSC-GORMS administrator.';

        $activationText = 'You can now log in to the system using your credentials.';
        $finalActivationText = "{$base} activated {$byTheAdmin}<br>{$activationText}";

        $deactivationText = 'You will not be able to access your account in the system.';
        $finalDeactivationText = "{$base} deactivated {$byTheAdmin}<br>{$deactivationText}";

        $deletionText = 'Your account does not exist in the system anymore.';
        $finalDeletionText = "{$base} deleted {$byTheAdmin}<br>{$deletionText}";

        return match ($this) {
            self::ACTIVATION => ['icon' => '✅', 'text' => $finalActivationText],
            self::DEACTIVATION => ['icon' => '⚠️', 'text' => $finalDeactivationText],
            self::DELETION => ['icon' => '🛑', 'text' => $finalDeletionText],
        };
    }
}
