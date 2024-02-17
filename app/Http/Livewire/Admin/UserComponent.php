<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
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

    public function deleteUser($userId) {
        $this->deletingUserId = $userId;
        $this->confirmUserDeletion();
    }

    public function confirmUserDeletion() {
        User::find($this->deletingUserId)->delete();
        session()->flash('success', 'Usuario eliminado correctamente.');
        $this->deletingUserId = null;
    }
    public function render()
    {
        $users = User::where('email', '<>', auth()->user()->email)
            ->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })->orderBy('id')->paginate();
    
        foreach ($users as $user) {
            $user->bio = strlen($user->bio) > 30 ? substr($user->bio, 0, 30) . '...' : $user->bio;
        }
    
        return view('livewire.admin.user-component', compact('users'))->layout('layouts.admin');
    }
}
