<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Profession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'bio' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'profession' => ['nullable', 'string', 'max:20'],
        ])->validate();

        // Crear el usuario
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'bio' => $input['bio'],
            'twitter' => $input['twitter'],
            'profession' => $input['profession'],
        ]);

        // Almacenar la profesión en la base de datos si se proporciona
        if ($input['profession']) {
            $profession = new Profession(['title' => $input['profession']]);
            $user->professions()->save($profession);
        }

        return $user;
    }
}