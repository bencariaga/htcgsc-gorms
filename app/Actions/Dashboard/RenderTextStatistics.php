<?php

namespace App\Actions\Dashboard;

use App\Enums\{AppointmentTime, NonDB\DashboardStyling};
use App\Models\{Appointment, Student};
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

class RenderTextStatistics
{
    public function handle(CarbonInterface $now): array
    {
        $nextAppointment = Appointment::where('appointment_status', 'Scheduled')->where(fn ($q) => $q->whereDate('appointment_date', '>', $now->toDateString())->orWhere(fn ($sq) => $sq->whereDate('appointment_date', $now->toDateString())->where('appointment_time', '>', $now->toTimeString())))->orderBy('appointment_date')->orderBy('appointment_time')->first();
        $nextAppointmentTime = 'No upcoming appointments';

        if ($nextAppointment) {
            $date = Carbon::parse($nextAppointment->appointment_date);
            $time = Carbon::parse($nextAppointment->appointment_time instanceof AppointmentTime ? $nextAppointment->appointment_time->toTwentyFourHour() : $nextAppointment->appointment_time)->format('g:i A');

            $prefix = match (true) {
                $date->isToday() => 'Today',
                $date->isTomorrow() => 'Tomorrow',
                default => 'On ' . $date->format('M. d, Y'),
            };

            $nextAppointmentTime = "{$prefix}, {$time}";
        }

        $metrics = [
            'Submissions' => [Appointment::class, null],
            'Students' => [Student::class, null],
            'Referrals' => [Student::class, 'referrals'],
            'Self Referrers' => [Student::class, 'self_referrals'],
            'Non Self Referrers' => [Student::class, 'no_referrals'],
        ];

        $rawStats = [['type' => DashboardStyling::TODAY_APPOINTMENTS, 'total' => Appointment::whereDate('appointment_date', $now->toDateString())->where('appointment_status', 'Scheduled')->count(), 'subtext' => "Next: {$nextAppointmentTime}"]];

        foreach ($metrics as $key => [$model, $relation]) {
            $query = $model::query();
            $relations = ['referrals' => fn ($q) => $q->has('referrals'), 'no_referrals' => fn ($q) => $q->doesntHave('referrals'), 'self_referrals' => fn ($q) => $q->whereHas('referrals.appointment', fn ($sub) => $sub->where('referral_type', 'Yourself'))];

            if (collect($relations)->has($relation)) {
                $relations[$relation]($query);
            }

            /** @var mixed $type */
            $type = (new \ReflectionClass(DashboardStyling::class))->getConstant('TOTAL_' . str($key)->snake()->upper());
            $rawStats[] = ['type' => $type, 'total' => (clone $query)->count(), 'subtext' => $type->generateSubtext((clone $query)->whereYear('created_at', $now->year)->count())];
        }

        $texts = collect($rawStats)->map(function ($stats) {
            $properties = ['total', 'subtext', 'label', 'icon', 'iconSize', 'subIcon', 'subIconSize', 'colors'];
            $result = [];

            foreach ($properties as $property) {
                $result[$property] = collect($stats)->has($property) ? $stats[$property] : $stats['type']->$property();
            }

            return $result;
        })->all();

        return compact('texts', 'nextAppointment', 'nextAppointmentTime');
    }
}
