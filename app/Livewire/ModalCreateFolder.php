<?php

namespace App\Livewire;

use App\Models\Folder;
use Livewire\Component;

class ModalCreateFolder extends Component
{

    public $showModal = false;
    public $folder;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {

        $folder = Folder::find($this->folder);

        return view('livewire.modal-create-folder', compact('folder'));
    }
}
