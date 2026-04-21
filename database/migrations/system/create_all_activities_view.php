<?php

use Illuminate\{Database\Migrations\Migration, Support\Facades\DB};

return new class extends Migration {
    public function up(): void
    {
        DB::statement($this->createView());
    }

    public function down(): void
    {
        DB::statement($this->dropView());
    }

    private function createView(): string
    {
        $query = "
            (
                SELECT
                    referrals.referral_id AS referral_id,
                    referrals.student_id AS student_id,
                    NULL AS referrer_id,
                    referrals.created_at AS created_at,
                    referrals.updated_at AS updated_at,
                    NULL AS appointment_id,
                    NULL AS referral_type,
                    NULL AS reason,
                    NULL AS appointment_date,
                    NULL AS appointment_time,
                    NULL AS appointment_status,
                    referrals.student_id AS laravel_foreign_key,
                    'App\\\Models\\\Referral' AS laravel_model,
                    'appointment_id,referral_type,reason,appointment_date,appointment_time,appointment_status' AS laravel_placeholders,
                    '' AS laravel_with
                FROM referrals
            )
            UNION ALL
            (
                SELECT
                    appointments.referral_id AS referral_id,
                    NULL AS student_id,
                    appointments.referrer_id AS referrer_id,
                    appointments.created_at AS created_at,
                    appointments.updated_at AS updated_at,
                    appointments.appointment_id AS appointment_id,
                    appointments.referral_type AS referral_type,
                    appointments.reason AS reason,
                    appointments.appointment_date AS appointment_date,
                    appointments.appointment_time AS appointment_time,
                    appointments.appointment_status AS appointment_status,
                    referrals.student_id AS laravel_foreign_key,
                    'App\\\Models\\\Appointment' AS laravel_model,
                    'student_id' AS laravel_placeholders,
                    '' AS laravel_with
                FROM appointments
                JOIN referrals ON referrals.referral_id = appointments.referral_id
            )";

        return "CREATE VIEW all_activities AS ($query)";
    }

    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS all_activities;';
    }
};
