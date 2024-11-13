{{-- Vincular con view admin.layouts.app --}}
@extends('admin.layouts.app')

{{-- Crear una seccion para mostrar el tablero del dashboard --}}
@section('content')
    <div class="row">
        {{-- agregar la barra lateral (sidebar) --}}
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <h3 class="p-4">Dashboard</h3>
                {{-- Ordenes de hoy --}}
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="row no-gutters align-content-center">
                                <div class="col-auto">
                                    <div class="icon-box text-info" style="font-size: 2rem;">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="col ml-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-info text-uppercase">
                                            Ordenes de hoy
                                        </div>
                                        <span class="badge bg-info">
                                            {{-- mostrar la cantidad de ordenes de hoy --}}
                                            {{ $todayOrders->count() }}
                                        </span>
                                    </div>
                                    <div class="pt-2">
                                        <span class="text-muted">Total: </span>
                                        <strong>
                                            ${{ $todayOrders->sum('total') }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Ordenes de ayer --}}
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="row no-gutters align-content-center">
                                <div class="col-auto">
                                    <div class="icon-box text-success" style="font-size: 2rem;">
                                        <i class="fa fa-shopping-bag"></i>
                                    </div>
                                </div>
                                <div class="col ml-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-success text-uppercase">
                                            Ordenes de ayer
                                        </div>
                                        <span class="badge bg-success">
                                            {{-- mostrar la cantidad de ordenes de ayer --}}
                                            {{ $yesterdayOrders->count() }}
                                        </span>
                                    </div>
                                    <div class="pt-2">
                                        <span class="text-muted">Total: </span>
                                        <strong>
                                            ${{ $yesterdayOrders->sum('total') }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Ordenes de mes --}}
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="row no-gutters align-content-center">
                                <div class="col-auto">
                                    <div class="icon-box text-warning" style="font-size: 2rem;">
                                        <i class="fa fa-archive"></i>
                                    </div>
                                </div>
                                <div class="col ml-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-warning text-uppercase">
                                            Ordenes del Mes
                                        </div>
                                        <span class="badge bg-warning">
                                            {{-- mostrar la cantidad de ordenes del mes --}}
                                            {{ $monthOrders->count() }}
                                        </span>
                                    </div>
                                    <div class="pt-2">
                                        <span class="text-muted">Total: </span>
                                        <strong>
                                            ${{ $monthOrders->sum('total') }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Ordenes de año --}}
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="row no-gutters align-content-center">
                                <div class="col-auto">
                                    <div class="icon-box text-danger" style="font-size: 2rem;">
                                        <i class="fa fa-cubes"></i>
                                    </div>
                                </div>
                                <div class="col ml-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-danger text-uppercase">
                                            Ordenes del año
                                        </div>
                                        <span class="badge bg-danger">
                                            {{-- mostrar la cantidad de ordenes del año  --}}
                                            {{ $yearOrders->count() }}
                                        </span>
                                    </div>
                                    <div class="pt-2">
                                        <span class="text-muted">Total: </span>
                                        <strong>
                                            ${{ $yearOrders->sum('total') }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
