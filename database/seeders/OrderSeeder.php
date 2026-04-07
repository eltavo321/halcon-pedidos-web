<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'invoice_number' => 'FAC-001',
            'customer_name' => 'Juan Perez',
            'customer_number' => 'C001',
            'order_date' => now(),
            'delivery_address' => 'Cancún, México',
            'status' => Order::STATUS_IN_PROCESS,
            'process_name' => 'Empaquetado',
            'process_date' => now(),
            'created_by' => 1,
        ]);

        Order::create([
            'invoice_number' => 'FAC-002',
            'customer_name' => 'Maria Lopez',
            'customer_number' => 'C002',
            'order_date' => now(),
            'delivery_address' => 'Playa del Carmen',
            'status' => Order::STATUS_DELIVERED,
            'created_by' => 1,
        ]);
    }
}