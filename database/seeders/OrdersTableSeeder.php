<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $customers = User::role('customer')->get();
        $products = Product::all();

        foreach ($customers as $customer) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                $product = $products->random();
                $quantity = rand(1, 3);

                Order::create([
                    'user_id' => $customer->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'total_price' => $product->price * $quantity,
                    'status' => ['pending', 'completed', 'shipped'][rand(0, 2)],
                    'customer_name' => $customer->name,
                    'customer_email' => $customer->email,
                    'customer_phone' => '123-456-7890',
                    'customer_address' => '123 Main St, Anytown, USA',
                ]);
            }
        }

        // Create some guest orders
        for ($i = 0; $i < 5; $i++) {
            $product = $products->random();
            $quantity = rand(1, 3);

            Order::create([
                'user_id' => null,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'total_price' => $product->price * $quantity,
                'status' => ['pending', 'completed', 'shipped'][rand(0, 2)],
                'customer_name' => 'Guest Customer ' . ($i + 1),
                'customer_email' => 'guest' . ($i + 1) . '@example.com',
                'customer_phone' => '123-456-789' . $i,
                'customer_address' => (100 + $i) . ' Guest St, Anytown, USA',
            ]);
        }
    }
}
