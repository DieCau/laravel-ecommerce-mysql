<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSizeRequest extends FormRequest
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
        return [                                            // Parametro que nos ayuda a editar un color
            'name' => 'required|max:255|unique:sizes, name,'.$this->size->id,
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
