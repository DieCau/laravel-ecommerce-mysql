@extends('admin.layouts.app')

{{-- Crear una seccion para mostrar el tablero del dashboard --}}
@section('content')
    <div class="row">
        {{-- agregar la barra lateral (sidebar) --}}
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="py-4">Productos</h3>
                    <a href="{{ route('admin.products.create')}}" class="btn btn-sm btn-primary">Crear Producto
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
                            <th scope="col">Colores</th>
                            <th scope="col">Tamaños</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Imagenes</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        {{-- Usar bucle "foreach" para recorrer cada registro e imprimir en cada fila  --}}
                        @foreach ($products as $key => $product)
                            {{-- Fila --}}
                            <tr>
                                <th scope="row">{{ $key += 1 }}</th>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @foreach ($product->colors as $color)
                                        <span class="badge bg-ligth text-dark">
                                            {{ $color->name }}
                                        </span>                                        
                                    @endforeach                                    
                                </td>
                                <td>
                                    @foreach ($products->sizes as $size)
                                        <span class="badge bg-ligth text-dark">
                                            {{ $size->name }}
                                        </span>                                        
                                    @endforeach                                    
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" 
                                            class="img-fluid rounded mb-1 border border-muted" width="30" height="30">

                                        @if($product->first_image)                                            
                                            <img src="{{ asset($product->first_image) }}" alt="{{ $product->name }}" 
                                            class="img-fluid rounded mb-1" width="30" height="30">
                                        @endif

                                        @if($product->second_image)                                            
                                            <img src="{{ asset($product->second_image) }}" alt="{{ $product->name }}" 
                                            class="img-fluid rounded mb-1" width="30" height="30">
                                        @endif

                                        @if($product->third_image)                                            
                                            <img src="{{ asset($product->third_image) }}" alt="{{ $product->name }}" 
                                            class="img-fluid rounded mb-1" width="30" height="30">
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    {{-- verificar si tiene stock el producto --}}
                                    @if ($product->status)
                                        <span class="bagde bg-success p-2">
                                            En stock
                                        </span> 
                                    @else
                                        <span class="bagde bg-danger p-2">
                                            Sin stock
                                        </span> 
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.products.edit', $product->slug) }}" class="btn btn-sm btn-warning">Editar 
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <a href="#" onclick="deleteItem({{ $product->id }})" class="btn btn-sm btn-danger">Eliminar
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form id="{{ $product->id }}" action="{{ route('admin.products.destroy', $product->slug) }} " 
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
