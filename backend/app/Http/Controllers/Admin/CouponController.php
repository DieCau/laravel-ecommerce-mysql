<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // Mostrar una lista del recurso    
    public function index()
    {
        // Retornar y pasar los cupones a la view
        return view('admin.coupons.index')->with([
            // obtiene los cupones creados mas recientes al mas antiguo
            'coupons' => Coupon::latest()->get()
        ]);
    }

    // Mostrar el formulario para crear un nuevo recurso
    public function create()
    {
        return view('admin.coupons.create');
    }

    // Guardar un cupon recien creado en la DB
    // Pasar la instancia de la clase AddCouponRequest que se creo
    public function store(AddCouponRequest $request)
    {
        // Validar si el cupon a crear cumple con las reglas
        if($request -> validated()) 
        {
            // El nombre del cupon es ingresado en la DB
            Coupon::create($request->validated());
            
            // Una vez guardado, redirigir al user a la view coupons.index 
            return redirect()->route('admin.coupons.index')->with([
                // Mensaje
                'success' => 'El Cupón se ha registrado correctamente!'
            ]);
        }
    }

    // Mostrar un recurso específico
    public function show(Coupon $coupon)
    {
        // Si la pagina no fue encontrada se muestra el error 404
        abort(404);
    }

    // Mostrar el formulario para editar el recurso especificado
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit')->with([
            'coupon' => $coupon
        ]);
    }

    // Actualizar el recurso especificado en la DB 
    // Pasar la instancia de la clase "UpdatecouponRequest"   
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        if($request->validated()){
            $coupon->update($request->validated());
            return redirect()->route('admin.coupons.index')->with([
                'success' => 'El Cupón se ha actualizado correctamente'
            ]);
        }
    }

    // Eliminar el recurso especificado de la DB
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with([
            // configurar el mensaje 
            'success' => 'El Cupón se ha eliminado correctamente'
        ]);
    }
}
