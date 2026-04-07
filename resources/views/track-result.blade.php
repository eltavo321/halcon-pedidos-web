@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Estado del Pedido</h4>
                </div>

                <div class="card-body">

                    {{-- 📦 DATOS GENERALES --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Número de Factura:</strong> {{ $order->invoice_number }}
                        </div>
                        <div class="col-md-6">
                            <strong>Fecha del Pedido:</strong>
                            {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Cliente:</strong> {{ $order->customer_name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Dirección de Entrega:</strong> {{ $order->delivery_address }}
                        </div>
                    </div>

                    {{-- 🎯 ESTADO --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Estado Actual:</strong>

                            @php
                                $badge = match($order->status) {
                                    'ordered' => 'bg-secondary',
                                    'in_process' => 'bg-warning',
                                    'in_route' => 'bg-info',
                                    'delivered' => 'bg-success',
                                    default => 'bg-secondary'
                                };
                            @endphp

                            <span class="badge {{ $badge }} fs-6">
                                {{ $order->status_label }}
                            </span>
                        </div>
                    </div>

                    {{-- 📝 NOTAS --}}
                    @if($order->notes)
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Notas:</strong> {{ $order->notes }}
                        </div>
                    </div>
                    @endif

                    {{-- 🟡 EN PROCESO --}}
                    @if($order->status === \App\Models\Order::STATUS_IN_PROCESS)
                    <div class="alert alert-warning mt-3">
                        <h5>Pedido en Proceso</h5>
                        <p><strong>Proceso:</strong> {{ $order->process_name }}</p>
                        <p><strong>Fecha:</strong> {{ $order->process_date }}</p>
                    </div>
                    @endif

                    {{-- 🔵 EN RUTA --}}
                    @if($order->status === \App\Models\Order::STATUS_IN_ROUTE)
                    <div class="alert alert-info mt-3">
                        <h5>Pedido en Ruta</h5>

                        @if($order->routePhoto)
                            <img src="{{ asset('storage/' . $order->routePhoto->photo_path) }}" 
                                 class="img-fluid mt-2" style="max-width: 300px;">
                        @else
                            <p>El pedido va en camino...</p>
                        @endif
                    </div>
                    @endif

                    {{-- 🟢 ENTREGADO --}}
                    @if($order->status === \App\Models\Order::STATUS_DELIVERED)
                    <div class="alert alert-success mt-3">
                        <h5>¡Pedido Entregado!</h5>

                        @if($order->deliveredPhoto)
                            <img src="{{ asset('storage/' . $order->deliveredPhoto->photo_path) }}" 
                                 class="img-fluid mt-2" style="max-width: 300px;">
                        @else
                            <p>No hay evidencia de entrega.</p>
                        @endif
                    </div>
                    @endif

                    {{-- 🔙 BOTÓN --}}
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">
                        Nueva Consulta
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection