@extends('admin.layouts.app')

{{-- Crear una seccion para mostrar el tablero del dashboard --}}
@section('content')
    <div class="row">
        {{-- agregar la barra lateral (sidebar) --}}
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="py-4">Cupones</h3>
                    <a href="{{ route('admin.coupons.create')}}" class="btn btn-sm btn-primary">Crear Cupon
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                {{-- Muestra los diferentes mensajes --}}
                @session('success')
                    <div id="successMessage" class="alert alert-success my-2">
                        {{ session('success') }}
                    </div>
                @endsession

                <script src="{{ asset('js/message.js') }}"></script>

                <hr>
            </div>
            <div class="card-body">

                {{-- Aqui agrego la tabla --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">Validez</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        {{-- Usar bucle "foreach" para recorrer cada registro e imprimir en cada fila  --}}
                        @foreach ($coupons as $key => $coupon)
                            {{-- Fila --}}
                            <tr>
                                <th scope="row">{{ $key += 1 }}</th>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->discount }}</td>
                                <td>{{ $coupon->valid_until }}</td>
                                <td>
                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">Editar 
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <a href="#" onclick="deleteItem({{ $coupon->id }})" class="btn btn-sm btn-danger">Eliminar
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form id="{{ $coupon->id }}" action="{{ route('admin.coupons.destroy', $coupon->id) }} " 
                                        method="POST">
                                        @csrf
                                        {{-- Aqui metodo DELETE  --}}
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
