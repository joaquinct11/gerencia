<?php

namespace App\Actions\Fortify;

use App\Models\User;
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
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'apePat' => ['required', 'string', 'max:255'], // Reglas de validación para el campo 'apePat'
            'apeMat' => ['required', 'string', 'max:255'], // Reglas de validación para el campo 'apeMat'
            'tipo' => ['required', 'string', 'max:255'], // Reglas de validación para el campo 'tipo'
        ])->validate();
    
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'apePat' => $input['apePat'], // Añadir el campo 'apePat'
            'apeMat' => $input['apeMat'], // Añadir el campo 'apeMat'
            'tipo' => $input['tipo'], // Añadir el campo 'tipo'
        ]);
    }
}
