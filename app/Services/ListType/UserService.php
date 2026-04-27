<?php

namespace App\Services\ListType;

use App\{Actions\User\DeleteUser, Actions\User\SearchUsers, Actions\User\UpdateUserStatus};
use App\{Enums\AccountStatus, Models\User, Traits\Concerns\ManagesTransactions};
use Illuminate\{Contracts\Pagination\LengthAwarePaginator, Support\Facades\Log};

class UserService
{
    use ManagesTransactions;

    public function __construct(protected SearchUsers $searchUsers, protected UpdateUserStatus $updateStatus, protected DeleteUser $deleteUser) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        return $this->searchUsers->handle($search, $filter, $sortField, $sortDirection, $rowsPerPage);
    }

    public function searchUsers(string $search, string $sortField, string $sortDirection, int $limit): LengthAwarePaginator
    {
        return $this->handle($search, 'All', $sortField, $sortDirection, $limit);
    }

    public function update(User $user, array $data): void
    {
        $this->executeTransaction(function () use ($user, $data) {
            $user->update($data);
            Log::info("User record updated successfully for User ID: {$user->user_id}");
        }, 'Failed to update user record', ['user_id' => $user->user_id]);
    }

    public function activate(int|string $userId): void
    {
        $this->updateStatus->handle($userId, AccountStatus::Active);
    }

    public function deactivate(int|string $userId): void
    {
        $this->updateStatus->handle($userId, AccountStatus::Inactive);
    }

    public function delete(int $userId): void
    {
        $this->deleteUser->handle($userId);
    }
}
