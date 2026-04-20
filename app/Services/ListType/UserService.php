<?php

namespace App\Services\ListType;

use App\{Actions\User\DeleteUser, Actions\User\SearchUsers, Actions\User\UpdateUserStatus, Models\User};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
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
        $user->update($data);
    }

    public function activate(int $userId): void
    {
        $this->updateStatus->handle($userId, 'Active');
    }

    public function deactivate(int $userId): void
    {
        $this->updateStatus->handle($userId, 'Inactive');
    }

    public function delete(int $userId): void
    {
        $this->deleteUser->handle($userId);
    }
}
