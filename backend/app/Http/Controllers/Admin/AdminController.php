<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() 
    {
        // obtener las ordenes creadas de hoy 
        $todayOrders = Order::whereDay('created_at', Carbon::today())->get();
        
        // obtener las ordenes creadas de ayer
        $yesterdayOrders = Order::whereDay('created_at', Carbon::yesterday())->get();
        
        // obtener las ordenes creadas en el mes
        $monthOrders = Order::whereMonth('created_at', Carbon::now()->month)->get(); 
        
        // obtener las ordenes creadas en un año
        $yearOrders = Order::whereYear('created_at', Carbon::now()->year)->get(); 
        
        return view('admin.index')->with([
            // crear las variables para usar en la view
            'todayOrders' => $todayOrders,
            'yesterdayOrders' => $yesterdayOrders,
            'monthOrders' => $monthOrders,
            'yearOrders' => $yearOrders,
        ]);
    }
    
    public function login() 
    {
        // Si el admin inició sesión 
        if(!auth()->guard('admin')->check()) {
            return view('admin.login');
        }
        return redirect()->route('admin.index');
    }

    // Metodo de autenticar un user administrador
    public function auth(AuthAdminRequest $request) 
    {
        if($request->validated()) {
            if(auth()->guard('admin')->attempt([
                'email'=> $request->email,
                'password' => $request->password,
            ])){
                $request->session()->regenerate();
                return redirect()->route('admin.index');
            }else {
                return redirect()->route('admin.login')->with([
                    'error' => 'El E-mail y el Password no coinciden...'
                ]);
            }
        }
    }

    // Metodo para realizar el Logout
    public function logout() 
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.index');        
    }
}
