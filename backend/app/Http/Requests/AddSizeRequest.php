<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSizeRequest extends FormRequest
{
    // Determinar si el usuario está autorizado para realizar esta solicitud. Cambiar false x "true" 
    public function authorize(): bool
    {
        return true;
    }


    // Reglas de validación
    public function rules(): array
    {
        return [
                    // Requerido|max_caracteres=255|color unico  
            'name' => 'required|max:255|unique:sizes',
        ];
    }

    public function messages(): array
    {
        // Agregar las reglas para mensajes
        return [
            'name.required' => 'El nombre del Tamaño es obligatorio',
            'name.max' => 'El nombre del Tamaño no puede exceder los 255 caracteres',
            'name.unique' => 'El nombre del Tamaño ya esta registrado',
        ];
    }
}
