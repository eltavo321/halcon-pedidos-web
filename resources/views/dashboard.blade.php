@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pedidos</h5>
                    <h2 class="display-4">{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Usuarios</h5>
                    <h2 class="display-4">{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Pendientes</h5>
                    <h2 class="display-4">{{ $pendingOrders }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Entregados</h5>
                    <h2 class="display-4">{{ $deliveredOrders }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Acciones Rápidas
                </div>
                <div class="card-body">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-2 w-100">Crear Nuevo Pedido</a>
                    <a href="{{ route('users.create') }}" class="btn btn-success mb-2 w-100">Registrar Usuario</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-info mb-2 w-100">Listar Pedidos</a>
                    <a href="{{ route('orders.trashed') }}" class="btn btn-secondary w-100">Ver Pedidos Eliminados</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Últimos Pedidos
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($recentOrders as $order)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $order->invoice_number }}
                            <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : 'warning' }}">
                                {{ $order->status_label }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection