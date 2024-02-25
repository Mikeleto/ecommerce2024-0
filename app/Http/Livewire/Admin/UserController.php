<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserController 
{
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate($user->rules());

        $user->update($request->only('name', 'email', 'bio', 'twitter'));


        return redirect()->route('admin.users.edit', $user)->with('success', 'Usuario actualizado correctamente.');
    }
}