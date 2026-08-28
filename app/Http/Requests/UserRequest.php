<?php

namespace App\Http\Requests;

use App\Rules\ApellidoValido;
use App\Rules\NombreValido;
use App\Rules\PasswordValido;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [

            'name' => ['required', 'min:3', 'max:50', new NombreValido],
            'lastName' => ['required', 'min:3', 'max:50', new ApellidoValido],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', new PasswordValido],
        ];
    }

    public function messages()
    {
        return [

            // name
            'name.required' => 'El nombre de usuario es un campo obligatorio.',
            'name.min' => 'El nombre de usuario debe tener un mínimo de 3 caracteres.',
            'name.max' => 'El nombre de usuario debe tener un máximo de 50 caracteres.',

            // lastName
            'lastName.required' => 'El apellido de usuario es un campo obligatorio.',
            'lastName.min' => 'El apellido de usuario debe tener un mínimo de 3 caracteres.',
            'lastName.max' => 'El apellido de usuario debe tener un máximo de 50 caracteres.',

            // email
            'email.required' => 'El correo electrónico es un campo obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
            'email.max' => 'El correo electrónico debe tener un máximo de 255 caracteres.',
            'email.unique' => 'El correo que ha ingresado ya ha sido registrado.',

            // password
            'password.required' => 'La contraseña es un campo obligatorio.',
            'password.confirmed' => 'La contraseña ingresada no coincide.',

        ];
    }

}
