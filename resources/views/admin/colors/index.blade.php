@extends('admin.layouts.app')

{{-- Crear una seccion para mostrar el tablero del dashboard --}}
@section('content')
    <div class="row">
        {{-- agregar la barra lateral (sidebar) --}}
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="p-4">Colores</h3>
                    <a href="{{ route('admin.colors.create')}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                @session('success')
                    <div class="alert alert-success my-2">
                        {{ session('success') }}
                    </div>                    
                @endsession
                <hr>
            </div>
            <div class="card-body">

                {{-- Aqui agrego la tabla --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        {{-- Usar bucle "foreach" para recorrer cada registro e imprimir en cada fila  --}}
                        @foreach ($colors as $color)
                            {{-- Fila --}}
                            <tr>
                                <th scope="row">{{ $color->id }}</th>
                                <td>{{ $color->name }}</td>
                                <td>
                                    <a href="{{ route('admin.colors.edit', $color->id) }}" class="btn btn-sm btn-warning">Editar 
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <a href="#" onclick="deleteItem({{ $color->id }})" class="btn btn-sm btn-danger">Eliminar
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form id="{{ $color->id }}" action="{{ route('admin.colors.destroy', $color->id) }} " 
                                        method="POST">
                                        @csrf
                                        Metodo 
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
