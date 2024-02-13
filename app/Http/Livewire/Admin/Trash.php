<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Trash extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch() {
        $this->resetPage();
    }

    public function assignRole(User $user, $value) {
        if ($value == '1') {
            $user->assignRole('admin');
        } else {
            $user->removeRole('admin');
        }
    }

    public function refreshComponent()
{
    $this->reset('search');
}
public function restoreUser($userId)
{
    $user = User::withTrashed()->find($userId);
    $user->restore();
    
    $this->refreshComponent();
}
  

    public function render() {
        $users = User::onlyTrashed()
            ->where('email', '<>', auth()->user()->email)
            ->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy('id')
            ->paginate();
    
        return view('livewire.admin.trash', compact('users'))->layout('layouts.admin');
    }
}
