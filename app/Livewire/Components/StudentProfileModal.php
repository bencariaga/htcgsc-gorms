<?php

namespace App\Livewire\Components;

use App\{Livewire\Forms\StudentProfileForm, Services\ListType\StudentService};
use Exception;
use Illuminate\View\View;
use Livewire\Component;

class StudentProfileModal extends Component
{
    public StudentProfileForm $form;

    public bool $show = false;

    public string $modalId = 'studentProfileModal';

    /** @var array */
    protected $listeners = ['open-modal' => 'handleOpenModal'];

    public function handleOpenModal(string $id, ?array $student = null): void
    {
        if ($id === $this->modalId) {
            $this->open($student);
        }
    }

    public function open(array $data): void
    {
        $this->form->setValues($data);
        $this->show = true;
    }

    public function submit(StudentService $service): void
    {
        $validated = $this->form->validate();

        try {
            $service->update($this->form->student_id, $validated);
            $this->show = false;
            $this->dispatch('hide-loading-accounts');
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Student profile updated successfully!']);
            $this->dispatch('refreshList');
        } catch (Exception $e) {
            $this->dispatch('hide-loading-accounts');
            $this->addError('form_error', $e->getMessage());
        }
    }

    public function render(): View
    {
        return view('livewire.components.student-profile-modal');
    }
}
