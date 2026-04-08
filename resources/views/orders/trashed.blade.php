@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📦 Pedidos Eliminados</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
            ← Volver
        </a>
    </div>

    <!-- Tabla -->
    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Factura</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Eliminado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody class="text-center">

                @forelse($orders as $order)
                    <tr>
                        <td><strong>#{{ $order->invoice_number }}</strong></td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->order_date->format('d/m/Y') }}</td>

                        <td>
                            @php
                                $badge = match($order->status) {
                                    'ordered' => 'secondary',
                                    'in_process' => 'warning',
                                    'in_route' => 'info',
                                    'delivered' => 'success',
                                    default => 'secondary'
                                };
                            @endphp

                            <span class="badge bg-{{ $badge }}">
                                {{ $order->status_label }}
                            </span>
                        </td>

                        <td>
                            {{ $order->deleted_at 
                                ? $order->deleted_at->format('d/m/Y H:i') 
                                : '-' 
                            }}
                        </td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                <!-- Restaurar -->
                                <form action="{{ route('orders.restore', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">
                                        Restaurar
                                    </button>
                                </form>

                                <!-- Eliminar definitivo -->
                                <form action="{{ route('orders.force-delete', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-muted py-4">
                            No hay pedidos eliminados
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-3">
                {{ $orders->links() }}
            </div>

        </div>
    </div>

</div>

@endsection