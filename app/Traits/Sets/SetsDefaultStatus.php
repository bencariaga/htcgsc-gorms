<?php

namespace App\Traits\Sets;

use App\Enums\Enums;

trait SetsDefaultStatus
{
    protected static function bootSetsDefaultStatus()
    {
        static::creating(function ($model) {
            if (collect($model->getAttributes())->has('account_status') || collect($model->getFillable())->contains('account_status')) {
                $model->account_status ??= collect(Enums::accountStatuses())->keys()->first();
            }

            if (collect($model->getAttributes())->has('appointment_status') || collect($model->getFillable())->contains('appointment_status')) {
                $model->appointment_status ??= collect(Enums::appointmentStatuses())->keys()->first();
            }
        });
    }
}
