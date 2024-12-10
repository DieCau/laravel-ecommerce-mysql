@extends('admin.layouts.app')

{{-- Crear una seccion para mostrar el tablero del dashboard --}}
@section('content')
    <div class="row">
        {{-- agregar la barra lateral (sidebar) --}}
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <h3 class="p-4">Editar Producto</h3>
                <hr>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('admin.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            @method('PUT')
                            
                            {{-- Nombre del producto --}}
                            <div class="form-floating mb-3">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="floatingInput" placeholder="Producto..." 
                                    value="{{ $product->name, old('name') }}"> 
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
                                    value="{{ $product->quantity, old('quantity') }}">                                   
                                    
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
                                    placeholder="Precio..."  value="{{ $product->price, old('price') }}">                                   
                                    
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
                                <label for="color_id" class="my-2">Selecciona los Colores</label>
                                <select name="color_id[]" id="color_id" 
                                {{-- "multiple" es para que se puedan seleccionar varios colores --}}
                                class="form-control @error('color_id') is-invalid @enderror" multiple>
                                    @foreach ($colors as $color)
                                        <option @if(collect(old('color_id'))->contains($color->id)
                                            || $product->colors->contains($color->id)
                                            ) selected @endif 
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
                                        <option @if (collect(old('size_id'))->contains($size->id)
                                            || $product->sizes->contains($size->id)
                                            ) selected @endif 
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
                                    class="form-control summernote  
                                    @error('desc') is-invalid @enderror" name="desc"
                                    id="floatingInput" placeholder="Descripcion..."> 
                                    {{ $product->desc, old('desc') }}
                                </textarea>

                                {{-- Aqui mensaje de error para Descripcion --}}
                                @error('desc')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Miniatura del producto --}}
                            <div class="mb-3">
                                <label for="thumbnail" class="my-2">Imagen Miniatura</label>
                                <input type="file" class="form-control 
                                @error('thumbnail') is-invalid @enderror" name="thumbnail" 
                                id="thumbnail"

                                {{-- Aqui mensaje de error para Miniatura --}}
                                @error('thumbnail')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <img src="{{ asset($product->thumbnail) }}" id="thumbnail_preview"
                                class="@if(!$product->thumbnail) d-none @endif
                                img-fluid rounded mb-2 border border-muted"
                                width="100" height="100">
                            </div>
                            
                            {{-- Primera Imagen del producto --}}
                            <div class="mb-3">
                                <label for="first_image" class="my-2">Primera Imagen</label>
                                <input type="file" class="form-control 
                                @error('first_image') is-invalid @enderror" name="first_image" 
                                id="first_image"

                                {{-- Aqui mensaje de error para Primera Imagen --}}
                                @error('first_image')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <img src="{{ asset($product->first_image) }}" id="first_image_preview"
                                class="img-fluid rounded mb-2 border border-muted 
                                @if (!$product->first_image) d-none @endif"
                                width="100" height="100">
                            </div>
                           
                            {{-- Segunda Imagen del producto --}}
                            <div class="mb-3">
                                <label for="second_image" class="my-2">Segunda Imagen</label>
                                <input type="file" class="form-control 
                                @error('second_image') is-invalid @enderror" name="second_image" 
                                id="second_image"

                                {{-- Aqui mensaje de error para Segunda Imagen --}}
                                @error('second_image')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <img src="{{ asset($product->second_image) }}" id="second_image_preview"
                                class="img-fluid rounded mb-2 border border-muted 
                                @if (!$product->second_image) d-none @endif"
                                width="100" height="100">
                            </div>

                            {{-- Tercera Imagen del producto --}}
                            <div class="mb-3">
                                <label for="third_image" class="my-2">Tercera Imagen</label>
                                <input type="file" class="form-control 
                                @error('third_image') is-invalid @enderror" name="third_image" 
                                id="third_image"

                                {{-- Aqui mensaje de error para Tercera Imagen --}}
                                @error('third_image')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <img src="{{ asset($product->third_image) }}" id="third_image_preview"
                                class="img-fluid rounded mb-2 border border-muted 
                                @if (!$product->third_image) d-none @endif"
                                width="100" height="100">
                            </div> 

                            <div class="mb-2">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Guardar Cambios
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
