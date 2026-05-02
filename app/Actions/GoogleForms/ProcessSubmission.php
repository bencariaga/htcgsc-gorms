<?php

namespace App\Actions\GoogleForms;

use App\{Enums\AppointmentTime, Models\Appointment, Services\Miscellaneous\SanitizationService};
use Exception;
use Illuminate\Support\Facades\{DB, Log};

class ProcessSubmission
{
    protected SanitizationService $sanitizationService;

    protected GetOrCreateEntity $getOrCreateEntity;

    public function __construct(SanitizationService $sanitizationService, GetOrCreateEntity $getOrCreateEntity)
    {
        $this->sanitizationService = $sanitizationService;
        $this->getOrCreateEntity = $getOrCreateEntity;
    }

    public function execute(array $data): bool
    {
        try {
            return DB::transaction(function () use ($data) {
                $data = $this->sanitizationService->ensureReferralIntegrity($data);
                $referrerEntity = $this->getOrCreateEntity->execute($data, 'Referrer');
                $referralEntity = $this->getOrCreateEntity->execute($data, 'Referral');
                $appointmentDate = $this->sanitizationService->limitDateRange($data['appointment_date']);
                $timeEnum = AppointmentTime::from($data['appointment_time']);
                $scheduled = $this->sanitizationService->scheduleAppointment($appointmentDate, $timeEnum->toIsoTime());

                Appointment::updateOrCreate(
                    [
                        'referrer_id' => $referrerEntity->referrer_id,
                        'referral_id' => $referralEntity->referral_id,
                        'appointment_date' => $scheduled['date'],
                        'appointment_time' => $scheduled['time'],
                    ],
                    [
                        'referral_type' => $data['referral_type'],
                        'reason' => $this->sanitizationService->filterProfanity($data['reason']),
                        'appointment_status' => 'Scheduled',
                    ],
                );

                Log::channel('google_forms')->info('Google Form Submission Data:', $data);

                return true;
            });
        } catch (Exception $e) {
            Log::error('Google Form Processing Error', [
                'timestamp' => now()->toIso8601String(),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'input_data' => $data,
                'trace' => $e->getTraceAsString(),
            ]);

            return false;
        }
    }
}
