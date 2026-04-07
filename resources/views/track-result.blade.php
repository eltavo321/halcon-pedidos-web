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
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Número de Factura:</strong> {{ ->invoice_number }}
                        </div>
                        <div class="col-md-6">
                            <strong>Fecha del Pedido:</strong> {{ \Carbon\Carbon::parse(->order_date)->format('d/m/Y') }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Cliente:</strong> {{ ->customer_name }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Dirección de Entrega:</strong> {{ ->delivery_address }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Estado Actual:</strong>
                            @php
                                 = match(->status) {
                                    'ordered' => 'bg-secondary',
                                    'in_process' => 'bg-warning',
                                    'in_route' => 'bg-info',
                                    'delivered' => 'bg-success',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{  }} fs-6">{{ ->status_label }}</span>
                        </div>
                    </div>
                    
                    @if(->notes)
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Notas:</strong> {{ ->notes }}
                        </div>
                    </div>
                    @endif
                    
                    @if(->status == 'delivered' && ->delivery_photo)
                    <div class="alert alert-success mt-3">
                        <h5>¡Pedido Entregado!</h5>
                        <img src="{{ asset('storage/' . ->delivery_photo->photo_path) }}" class="img-fluid mt-2" style="max-width: 300px;">
                    </div>
                    @endif
                    
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Nueva Consulta</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
