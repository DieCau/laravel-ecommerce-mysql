<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|max:255|unique:products',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'color_id' => 'required',
            'size_id' => 'required',
            'desc' => 'required|max:2000',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'first_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'second_image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'third_image' => 'image|mimes:png,jpg,jpeg|max:2048',
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'El Producto es obligatorio',
            'name.max' => 'El nombre del producto no debe exceder los 255 caracteres',
            'name.unique' => 'El Producto ya esta registrado',
            
            'quantity.required' => 'La cantidad es obligatoria',
            'quantity.numeric' => 'La cantidad debe ser un numero',
            
            'price.required' => 'El precio es obligatorio',
            'price.numeric' => 'El precio debe ser un numero',
            
            'color_id.required' => 'El color es obligatorio',
            'size_id.required' => 'El tamaño es obligatorio',
            
            'desc.required' => 'La descripción es obligatoria',
            'desc.max' => 'La descripción no debe exceder los 255 caracteres',
            
            'thumbnail.required' => 'La imagen de la miniatura es obligatoria',
            'thumbnail.image' => 'La imagen de la miniatura debe ser una imagen',
            'thumbnail.mimes' => 'La imagen de la miniatura debe ser un archivo tipo: jpg, jpeg, png',
            'thumbnail.max' => 'El imagen de la miniatura no puede exceder los 2MB',

            'first_image.image' => 'La primera imagen debe ser una imagen',
            'first_image.mimes' => 'La primera imagen debe ser un archivo tipo: jpg, jpeg, png',
            'first_image.max' => 'La primera imagen no puede exceder los 2MB',
            
            'second_image.image' => 'La segunda imagen debe ser una imagen',
            'second_image.mimes' => 'La segunda imagen debe ser un archivo tipo: jpg, jpeg, png',
            'second_image.max' => 'La segunda imagen no puede exceder los 2MB',
            
            'third_image.image' => 'La tercera imagen debe ser una imagen',
            'third_image.mimes' => 'La tercera imagen debe ser un archivo tipo: jpg, jpeg, png',
            'third_image.max' => 'La tercera imagen no puede exceder los 2MB',
           
        ];
    }
}
