<?php

namespace App\Traits\Sets;

use App\Enums\Enums;
use Illuminate\Support\Arr;

trait SetsDefaultStatus
{
    protected static function bootSetsDefaultStatus()
    {
        static::creating(function ($model) {
            if (Arr::exists($model->getAttributes(), 'account_status') || collect($model->getFillable())->contains('account_status')) {
                $model->account_status ??= collect(Enums::accountStatuses())->keys()->first();
            }

            if (Arr::exists($model->getAttributes(), 'appointment_status') || collect($model->getFillable())->contains('appointment_status')) {
                $model->appointment_status ??= collect(Enums::appointmentStatuses())->keys()->first();
            }
        });
    }
}
