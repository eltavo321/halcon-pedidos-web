<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Photo;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 📋 LISTADO
    public function index(Request $request)
    {
        $query = Order::with(['creator', 'photos'])->orderBy('created_at', 'desc');

        if ($request->filled('invoice_number')) {
            $query->where('invoice_number', 'like', '%' . $request->invoice_number . '%');
        }

        if ($request->filled('customer_number')) {
            $query->where('customer_number', 'like', '%' . $request->customer_number . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('order_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('order_date', '<=', $request->date_to);
        }

        $orders = $query->paginate(15);
        $statuses = Order::$statuses;

        return view('orders.index', compact('orders', 'statuses'));
    }

    // 📝 CREAR
    public function create()
    {
        if (!in_array(auth()->user()->role?->name, ['admin', 'sales'])) {
            abort(403);
        }

        return view('orders.create');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role?->name, ['admin', 'sales'])) {
            abort(403);
        }

        $request->validate([
            'invoice_number' => 'required|unique:orders',
            'customer_name' => 'required|string|max:255',
            'customer_number' => 'required|string|max:50',
            'fiscal_data' => 'nullable|string',
            'order_date' => 'required|date',
            'delivery_address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Order::create([
            'invoice_number' => $request->invoice_number,
            'customer_name' => $request->customer_name,
            'customer_number' => $request->customer_number,
            'fiscal_data' => $request->fiscal_data,
            'order_date' => $request->order_date,
            'delivery_address' => $request->delivery_address,
            'notes' => $request->notes,
            'status' => Order::STATUS_ORDERED,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Pedido creado.');
    }

    // 👁️ VER
    public function show(Order $order)
    {
        $order->load(['routePhoto', 'deliveredPhoto']);
        return view('orders.show', compact('order'));
    }

    // ✏️ EDITAR
    public function edit(Order $order)
    {
        if (!in_array(auth()->user()->role?->name, ['admin', 'sales'])) {
            abort(403);
        }

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        if (!in_array(auth()->user()->role?->name, ['admin', 'sales'])) {
            abort(403);
        }

        $request->validate([
            'invoice_number' => 'required|unique:orders,invoice_number,' . $order->id,
            'customer_name' => 'required|string|max:255',
            'customer_number' => 'required|string|max:50',
            'fiscal_data' => 'nullable|string',
            'order_date' => 'required|date',
            'delivery_address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Pedido actualizado.');
    }

    // 🔄 CAMBIO DE ESTADO
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Order::$statuses)),
            'process_name' => 'nullable|string'
        ]);

        $order->status = $request->status;

        if ($request->status === Order::STATUS_IN_PROCESS) {
            $order->process_name = $request->process_name;
            $order->process_date = now();
        }

        $order->save();

        return back()->with('success', 'Estado actualizado.');
    }

    // 📸 SUBIR FOTO (ARREGLADO)
    public function uploadPhoto(Request $request, Order $order)
    {
        if (!in_array(auth()->user()->role?->name, ['admin', 'route'])) {
            abort(403);
        }

        $request->validate([
            'photo' => 'required|image|max:5120',
            'photo_type' => 'required|in:in_route,delivered',
        ]);

        // 🔥 VALIDAR ARCHIVO
        if (!$request->hasFile('photo')) {
            return back()->with('error', 'No se seleccionó ninguna imagen.');
        }

        // 🔥 GUARDAR IMAGEN
        $path = $request->file('photo')->store('orders/' . $order->id, 'public');

        // 🔥 GUARDAR EN BD
        Photo::create([
            'order_id' => $order->id,
            'photo_path' => $path,
            'photo_type' => $request->photo_type,
            'uploaded_by' => auth()->id(),
        ]);

        // 🔥 CAMBIAR ESTADO AUTOMÁTICO
        if ($request->photo_type === 'in_route') {
            $order->update(['status' => Order::STATUS_IN_ROUTE]);
        }

        if ($request->photo_type === 'delivered') {
            $order->update(['status' => Order::STATUS_DELIVERED]);
        }

        return back()->with('success', 'Foto subida correctamente.');
    }

    // 🗑️ ELIMINADO LÓGICO
    public function destroy(Order $order)
    {
        if (auth()->user()->role?->name !== 'admin') {
            abort(403);
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pedido eliminado.');
    }

    // 📦 PAPELERA
    public function trashed()
    {
        if (auth()->user()->role?->name !== 'admin') {
            abort(403);
        }

        $orders = Order::onlyTrashed()
            ->with('creator')
            ->orderBy('deleted_at', 'desc')
            ->paginate(15);

        return view('orders.trashed', compact('orders'));
    }

    public function restore($id)
    {
        if (auth()->user()->role?->name !== 'admin') {
            abort(403);
        }

        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();

        return back()->with('success', 'Pedido restaurado.');
    }

    public function forceDelete($id)
    {
        if (auth()->user()->role?->name !== 'admin') {
            abort(403);
        }

        $order = Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();

        return back()->with('success', 'Eliminado permanentemente.');
    }
}