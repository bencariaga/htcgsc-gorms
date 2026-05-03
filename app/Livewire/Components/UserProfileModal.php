<?php

namespace App\Livewire\Components;

use App\{Enums\Enums, Livewire\Forms\UserProfileForm, Models\User, Services\ListType\UserService};
use Exception;
use Illuminate\View\View;
use Livewire\Component;

class UserProfileModal extends Component
{
    public UserProfileForm $form;

    public bool $show = false;

    public string $modalId = 'userProfileModal';

    /** @var array */
    protected $listeners = ['open-modal' => 'handleOpenModal'];

    public function handleOpenModal(string $id, ?array $user = null): void
    {
        if ($id === $this->modalId) {
            $this->open($user);
        }
    }

    public function open(array $data): void
    {
        $userId = $data['user_id'] ?? $data['user']['user_id'] ?? null;

        if ($userId) {
            $user = User::findOrFail($userId);
            $this->form->setValues($user);
            $this->show = true;
        }
    }

    public function submit(UserService $service): void
    {
        $validated = $this->form->validate();

        try {
            $service->update($this->form->user, $validated);
            $this->show = false;
            $this->dispatch('hide-loading-accounts');
            $this->dispatch('notify', ['type' => 'success', 'message' => 'User profile has been <strong>updated</strong> successfully!']);
            $this->dispatch('refreshList');
        } catch (Exception $e) {
            $this->dispatch('hide-loading-accounts');
            $this->addError('form_error', $e->getMessage());
        }
    }

    public function render(): View
    {
        return view('livewire.components.user-profile-modal', ['user' => $this->form->user, 'person' => $this->form->user?->person, 'suffixes' => Enums::suffixes()]);
    }
}
