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
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="floatingInput" placeholder="Producto..." 
                                    value="{{ old('name') }}"> 
                                <label for="floatingInput">Producto</label>

                                {{-- Aqui mensaje de error para Producto --}}
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>                                    
                                @enderror
                            </div>
                           
                            {{-- Cantidad del producto --}}
                            <div class="form-floating mb-3">
                                <input type="number" name="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror" 
                                    id="floatingInput" placeholder="Cantidad..."  
                                    value="{{ old('quantity') }}">                                   
                                    
                                <label for="floatingInput">Cantidad</label>

                                {{-- Aqui mensaje de error para Cantidad --}}
                                @error('quantity')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                            {{-- Precio del producto --}}
                            <div class="form-floating mb-3">
                                <input type="number" name="price"
                                    class="form-control @error('price') is-invalid @enderror" id="floatingInput"
                                    placeholder="Precio..."  value="{{ old('price') }}">                                   
                                    
                                <label for="floatingInput">Precio</label>

                                {{-- Aqui mensaje de error para Precio --}}
                                @error('price')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            {{-- Color del producto --}}
                            <div class="mb-3">
                                <label for="color_id" class="my-2 form-label">Selecciona los Colores</label>
                                <select name="color_id[]" id="color_id" 
                                {{-- "multiple" es para que se puedan seleccionar varios colores --}}
                                class="form-control @error('color_id') is-invalid @enderror" multiple>
                                    @foreach ($colors as $color)
                                        <option @if (collect(old('color_id'))->contains($color->id)) selected @endif 
                                            value="{{ $color->id }}">
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>                                

                                {{-- Aqui mensaje de error para Color --}}
                                @error('color_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            {{-- Tamaño del producto --}}
                            <div class="mb-3">
                                <label for="size_id" class="my-2">Selecciona los Tamaños</label>
                                <select name="size_id[]" id="size_id" 
                                class="form-control @error('size_id') is-invalid @enderror" multiple>
                                    @foreach ($sizes as $size)
                                        <option @if (collect(old('size_id'))->contains($size->id)) selected @endif 
                                            value="{{ $size->id }}">
                                            {{ $size->name }}
                                        </option>
                                    @endforeach
                                </select>                                

                                {{-- Aqui mensaje de error para Tamaño --}}
                                @error('size_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Descripcion del producto --}}
                            <div class="mb-3">
                                <label for="desc" class="my-2">Descripcion</label>
                                <textarea rows="10" 
                                    {{-- "summernote" es para funcione el editor de texto en el formulario --}}
                                    class="text-white form-control summernote  
                                    @error('desc') is-invalid @enderror" name="desc"
                                    id="floatingInput" placeholder="Descripcion..."> 
                                    {{ old('desc') }}
                                </textarea>

                                {{-- Aqui mensaje de error para Descripcion --}}
                                @error('desc')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Imagen del producto --}}
                            <div class="mb-3">
                                <label for="thumbnail" class="my-2">Imagen Miniatura</label>
                                <input type="file" class="form-control 
                                @error('thumbnail') is-invalid @enderror" name="thumbnail" 
                                id="floatingInput"

                                {{-- Aqui mensaje de error para Imagen --}}
                                @error('thumbnail')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            {{-- Primera Imagen del producto --}}
                            <div class="mb-3">
                                <label for="first_image" class="my-2">Primera Imagen</label>
                                <input type="file" class="form-control 
                                @error('first_image') is-invalid @enderror" name="first_image" 
                                id="floatingInput"

                                {{-- Aqui mensaje de error para Primera Imagen --}}
                                @error('first_image')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                            {{-- Segunda Imagen del producto --}}
                            <div class="mb-3">
                                <label for="second_image" class="my-2">Segunda Imagen</label>
                                <input type="file" class="form-control 
                                @error('second_image') is-invalid @enderror" name="second_image" 
                                id="floatingInput"

                                {{-- Aqui mensaje de error para Segunda Imagen --}}
                                @error('second_image')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Tercera Imagen del producto --}}
                            <div class="mb-3">
                                <label for="third_image" class="my-2">Tercera Imagen</label>
                                <input type="file" class="form-control 
                                @error('third_image') is-invalid @enderror" name="third_image" 
                                id="floatingInput"

                                {{-- Aqui mensaje de error para Tercera Imagen --}}
                                @error('third_image')
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
