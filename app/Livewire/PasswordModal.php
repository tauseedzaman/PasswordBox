<?php
namespace App\Livewire;

use Livewire\Component;

class PasswordModal extends Component
{
    public $passwordDetails = '';
    public $showModal = false;

    protected $listeners = ['showPasswordModal'];

    public function showPasswordModal($passwordId)
    {
        // Fetch the password details (replace this with actual fetching logic)
        $this->passwordDetails = "Details for Password ID: $passwordId";
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.password-modal');
    }
}
