<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCouponRequest extends FormRequest
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
                    // Requerido|max_caracteres=255|cupon unico  
            'name' => 'required|max:255|unique:coupons',
            'discount' => 'required',
            'valid_until' => 'required',
        ];
    }

    public function messages(): array
    {
        // Agregar las reglas para mensajes
        return [
            'name.required' => 'El nombre del cupon es obligatorio',
            'name.max' => 'El nombre del cupon no puede exceder los 255 caracteres',
            'name.unique' => 'El nombre del cupon ya esta registrado',
            'discount.required' => 'El descuento es obligatorio',
            'valid_until.required' => 'La fecha de validez es obligatorio',
        ];
    }
}
