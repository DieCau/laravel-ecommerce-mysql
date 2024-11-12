<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() 
    {
        return view('admin.index');
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
                    'error' => 'Email y Password no coinciden'
                ]);
            }
        }
    }
}
