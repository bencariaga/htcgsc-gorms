<?php

namespace App\Actions\User;

use App\{Contracts\UpdatesUserStatus, Data\UserStatusData, Enums\AccountStatus, Models\User};
use App\Mail\{NoticeAccountActivation, NoticeAccountDeactivation};
use App\{Services\Miscellaneous\TextBeeService, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\Facades\{Log, Mail};

class UpdateUserStatus implements UpdatesUserStatus
{
    use ManagesTransactions;

    public function handle(UserStatusData $data): void
    {
        $this->executeTransaction(function () use ($data) {
            $user = User::with('person')->findOrFail($data->userId);

            $user->update(['account_status' => $data->status]);
            $this->notifyUser($user, $data->status);

            Log::info("Account status updated to {$data->status->value} for User ID: {$data->userId}");
        }, "Status Update Failed for User {$data->userId}", ['user_id' => $data->userId, 'status' => $data->status->value]);
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
