@extends('admin.layouts.app')

{{-- Crear una seccion para mostrar el tablero del dashboard --}}
@section('content')
    <div class="row">
        {{-- agregar la barra lateral (sidebar) --}}
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <h3 class="p-4">Editar Cupon</h3>
                <hr>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                            @csrf
                            
                            @method('PUT')
                            
                             {{-- Nombre del cupon --}}
                             <div class="form-floating mb-3">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="floatingInput"
                                    placeholder="Cupon..." value="{{ $coupon->name, old('name') }}"> 
                                <label for="floatingInput">Cupon</label>
                           
                            {{-- Descuento del cupon --}}
                            <div class="form-floating mb-3">
                                <input type="number" name="discount"
                                    class="form-control @error('discount') is-invalid @enderror" id="floatingInput"
                                    placeholder="Descuento"  value="{{ $coupon->discount, old('discount') }}">                                   
                                    
                                <label for="floatingInput">Descuento</label>

                                {{-- Aqui mensaje de error para Descuento --}}
                                @error('discount')
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
                                    value="{{ $coupon->valid_until }}"> 
                                
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
