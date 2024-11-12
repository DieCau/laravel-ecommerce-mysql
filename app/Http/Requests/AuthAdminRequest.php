<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthAdminRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255',
        ];
    }

    // Validar las credenciales
    public function messages(): array
    {
        return [
            'email.required' => 'El E-mail es obligatorio',
            'email.email' => 'El E-mail debe ser una dirección válida',
            'email.max' => 'El E-mail no debe exceder los 255 caracteres',
            'password.required' => 'El Password es obligatorio',
            'password.min' => 'El Password debe tener al menos 6 caracteres',
            'password.max' => 'El Password no debe exceder los 255 caracteres',
        ];
    }
}
