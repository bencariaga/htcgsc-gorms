<?php

namespace App\Actions\User;

use App\{Contracts\UpdatesUserStatus, Data\UserStatusData, Enums\AccountStatus, Models\User};
use App\Mail\{NoticeAccountActivation, NoticeAccountDeactivation};
use App\Services\Miscellaneous\TextBeeService;
use Illuminate\Support\Facades\{DB, Log, Mail};
use Throwable;

class UpdateUserStatus implements UpdatesUserStatus
{
    public function handle(UserStatusData $data): void
    {
        DB::transaction(function () use ($data) {
            try {
                $user = User::with('person')->findOrFail($data->userId);
                $user->update(['account_status' => $data->status]);
                $this->notifyUser($user, $data->status);
                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                Log::error("Status Update Failed for User {$data->userId}: {$e->getMessage()}");
                throw $e;
            }
        });
    }

    protected function notifyUser(User $user, AccountStatus $status): void
    {
        $person = $user->person;

        if ($person->email_address) {
            $mailable = $status->value === 'Active' ? new NoticeAccountActivation($user) : new NoticeAccountDeactivation($user);
            Mail::to($person->email_address)->queue($mailable);
        }

        if ($person->phone_number) {
            $verb = $status->value === 'Active' ? 'activated' : 'deactivated';
            $message = "Your account \"{$person->full_name}\" has been {$verb} by the administrator.";
            app(TextBeeService::class)->sendSms([$person->phone_number], $message);
        }
    }
}
