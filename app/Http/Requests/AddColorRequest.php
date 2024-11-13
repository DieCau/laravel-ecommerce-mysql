<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddColorRequest extends FormRequest
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
        // Agregar las reglas para el/los atributo/s
        return [
                   // Requerido|max_caracteres=255|color unico  
            'name' => 'required|max:255|unique:colors',
        ];
    }
  
    public function messages(): array
    {
        // Agregar las reglas para mensajes
        return [
            'name.required' => 'El nombre del color es obligatorio',
            'name.max' => 'El nombre del color no puede exceder los 255 caracteres',
            'name.unique' => 'El nombre del color ya esta registrado',
        ];
    }
}
