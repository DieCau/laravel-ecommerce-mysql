<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

// Aqui se realiza el CRUD para Colors
class ColorController extends Controller
{
    // Mostrar una lista del recurso    
    public function index()
    {
        // Retornar y pasar los colores a la view
        return view('admin.colors.index')->with([
            // obtiene los colores creados mas recientes al mas antiguo
            'colors' => Color::latest()->get()
        ]);
    }

    // Mostrar el formulario para crear un nuevo recurso
    public function create()
    {
        return view('admin.colors.create');
    }

    // Guardar un recurso recién creado en la DB
    // Pasar la instancia de la clase AddColorRequest que se creo
    public function store(AddColorRequest $request)
    {
        // Validar si el color a crear cumple con las reglas
        if($request -> validated()) 
        {
            
            // Redirigir al user a la view colors.index 
            return redirect()->route('admin.colors.index')->with([
                // Mensaje
                'success' => 'El color se ha registrado correctamente!'
            ]);
        }
    }

    // Mostrar un recurso específico
    public function show(Color $color)
    {
        // Si la pagina no fue encontrada se muestra el error 404
        abort(404);
    }

    // Mostrar el formulario para editar el recurso especificado
    public function edit(Color $color)
    {
        return view('admin.colors.edit')->with([
            'color' => $color
        ]);
    }

    // Actualizar el recurso especificado en la DB 
    // Pasar la instancia de la clase "UpdateColorRequest"   
    public function update(UpdateColorRequest $request, Color $color)
    {
        if($request->validated){
            $color ->update($request->validated());
            return redirect()->route('admin.colors.index')->with([
                'success' => 'El color se ha actualizado correctamente'
            ]);
        }
    }

    // Eliminar el recurso especificado de la DB
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('admin.colors.index')->with([
            'success' => 'El color se ha eliminado correctamente'
        ]);
    }
}
