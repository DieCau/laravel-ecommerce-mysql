<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;

// Aqui se realiza el CRUD para Sizes
class SizeController extends Controller
{
    // Mostrar una lista del recurso    
    public function index()
    {
        // Retornar y pasar los sizes a la view
        return view('admin.sizes.index')->with([
            // obtiene los sizes creados mas recientes al mas antiguo
            'sizes' => Size::latest()->get()
        ]);
    }

    // Mostrar el formulario para crear un nuevo recurso
    public function create()
    {
        return view('admin.sizes.create');
    }

    // Guardar un size recien creado en la DB
    // Pasar la instancia de la clase AddSizeRequest que se creo
    public function store(AddSizeRequest $request)
    {
        // Validar si el size a crear cumple con las reglas
        if($request -> validated()) 
        {
            // El nombre del size es ingresado en la DB
            Size::create($request->validated());
            
            // Una vez guardado, redirigir al user a la view sizes.index 
            return redirect()->route('admin.sizes.index')->with([
                // Mensaje
                'success' => 'El Tamaño se ha registrado correctamente!'
            ]);
        }
    }

    // Mostrar un recurso específico
    public function show(Size $size)
    {
        // Si la pagina no fue encontrada se muestra el error 404
        abort(404);
    }

    // Mostrar el formulario para editar el recurso especificado
    public function edit(Size $size)
    {
        return view('admin.sizes.edit')->with([
            'size' => $size
        ]);
    }

    // Actualizar el recurso especificado en la DB 
    // Pasar la instancia de la clase "UpdatesizeRequest"   
    public function update(UpdateSizeRequest $request, Size $size)
    {
        if($request->validated){
            $size ->update($request->validated());
            return redirect()->route('admin.sizes.index')->with([
                'success' => 'El Tamaño se ha actualizado correctamente'
            ]);
        }
    }

    // Eliminar el recurso especificado de la DB
    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.sizes.index')->with([
            // configurar el mensaje 
            'success' => 'El Tamaño se ha eliminado correctamente'
        ]);
    }
}
