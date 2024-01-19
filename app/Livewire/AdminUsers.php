<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class AdminUsers extends Component
{

    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $users = User::paginate(10);

        return view('livewire.admin-users', compact('users'));
    }
}
