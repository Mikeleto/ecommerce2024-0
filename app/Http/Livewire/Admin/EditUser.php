<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('admin.edit-user');
    }

    public function update()
    {
        $this->validate([
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'user.bio' => 'required|string|max:255',
            'user.twitter' => 'required|url|max:255',
            'user.password' => 'nullable|string|min:8|confirmed',
        ]);

        if (!empty($this->user->password)) {
            $this->user->password = bcrypt($this->user->password);
        }

        $this->user->save();

        session()->flash('success', 'Usuario actualizado correctamente.');
    }
}