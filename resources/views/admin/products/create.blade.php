@extends('admin.layouts.app')

{{-- Crear una seccion para mostrar el tablero del dashboard --}}
@section('content')
    <div class="row">
        {{-- agregar la barra lateral (sidebar) --}}
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <h3 class="p-4">Nuevo Producto</h3>
                <hr>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        {{-- Al trabajar con imagenes necesitamos enctype --}}
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- Nombre del producto --}}
                            <div class="form-floating mb-3">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="floatingInput"
                                    placeholder="Producto..." value="{{ old('name') }}"> 
                                <label for="floatingInput">Producto</label>
                           
                            {{-- Cantidad del producto --}}
                            <div class="form-floating mb-3">
                                <input type="number" name="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror" id="floatingInput"
                                    placeholder="Cantidad"  value="{{ old('quantity') }}">                                   
                                    
                                <label for="floatingInput">Cantidad</label>

                                {{-- Aqui mensaje de error para Cantidad --}}
                                @error('quantity')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            {{-- Fecha de validez --}}
                            <div class="form-floating mb-3">
                                <input type="datetime-local" name="valid_until"
                                    class="form-control @error('valid_until') is-invalid @enderror" id="floatingInput"
                                    placeholder="Fecha de validez" 
                                    
                                    {{-- El user NO podra seleccionar la fecha actual ni anteriores --}}
                                    {{-- Formato de fecha y hora válidos ("T" es para separar f de h)--}}
                                    min="{{ \Carbon\carbon::tomorrow()->format('Y-m-d\Th:i:s') }}">  
                                
                                <label for="floatingInput">Fecha de Validez</label>

                                {{-- Aqui mensaje de error para Validez --}}
                                @error('valid_until')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Crear Producto
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
