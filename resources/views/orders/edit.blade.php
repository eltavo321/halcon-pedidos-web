@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Editar Pedido #{{ $order->invoice_number }}</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Número de Factura *</label>
                    <input type="text"
                           name="invoice_number"
                           class="form-control @error('invoice_number') is-invalid @enderror"
                           value="{{ old('invoice_number', $order->invoice_number) }}">

                    @error('invoice_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Número de Cliente *</label>
                    <input type="text"
                           name="customer_number"
                           class="form-control @error('customer_number') is-invalid @enderror"
                           value="{{ old('customer_number', $order->customer_number) }}">

                    @error('customer_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre / Razón Social *</label>
                <input type="text"
                       name="customer_name"
                       class="form-control @error('customer_name') is-invalid @enderror"
                       value="{{ old('customer_name', $order->customer_name) }}">

                @error('customer_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Datos Fiscales</label>
                <textarea name="fiscal_data"
                          class="form-control @error('fiscal_data') is-invalid @enderror">{{ old('fiscal_data', $order->fiscal_data) }}</textarea>

                @error('fiscal_data')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha del Pedido *</label>
                    <input type="datetime-local"
                           name="order_date"
                           class="form-control @error('order_date') is-invalid @enderror"
                           value="{{ old('order_date', $order->order_date->format('Y-m-d\TH:i')) }}">

                    @error('order_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Dirección de Entrega *</label>
                    <input type="text"
                           name="delivery_address"
                           class="form-control @error('delivery_address') is-invalid @enderror"
                           value="{{ old('delivery_address', $order->delivery_address) }}">

                    @error('delivery_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Notas</label>
                <textarea name="notes"
                          class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $order->notes) }}</textarea>

                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary">Actualizar Pedido</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection