<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = [
            ['nombre' => 'California Roll', 'precio' => 120.00, 'descripcion' => 'Roll clásico con cangrejo, aguacate y pepino.'],
            ['nombre' => 'Philadelphia Roll', 'precio' => 130.00, 'descripcion' => 'Roll con salmón, queso crema y aguacate.'],
            ['nombre' => 'Spicy Tuna Roll', 'precio' => 140.00, 'descripcion' => 'Roll picante con atún fresco y salsa especial.'],
            ['nombre' => 'Dragon Roll', 'precio' => 150.00, 'descripcion' => 'Roll con anguila, aguacate y salsa unagi.'],
            ['nombre' => 'Rainbow Roll', 'precio' => 160.00, 'descripcion' => 'Roll con una variedad de pescados frescos y aguacate.'],
            ['nombre' => 'Ebi Tempura Roll', 'precio' => 125.00, 'descripcion' => 'Roll con camarón tempura, aguacate y salsa especial.'],
            ['nombre' => 'Salmon Lover Roll', 'precio' => 170.00, 'descripcion' => 'Roll con salmón fresco, aguacate y topping de salmón.'],
            ['nombre' => 'Veggie Roll', 'precio' => 110.00, 'descripcion' => 'Roll vegetariano con pepino, zanahoria y aguacate.'],
            ['nombre' => 'Crunchy Roll', 'precio' => 135.00, 'descripcion' => 'Roll crujiente con camarón, queso crema y topping crocante.'],
            ['nombre' => 'Volcano Roll', 'precio' => 180.00, 'descripcion' => 'Roll con topping de salsa picante y mezcla de mariscos.'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }


        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Trabajador',
            'email' => 'trabajador@gmail.com',
            'password' => bcrypt('trabajador123'),
            'role' => 'trabajador',
        ]);

        for ($i = 1; $i <= 8; $i++) {
            $order = Order::create([
                'nombre_cliente' => fake()->name(),
                'telefono_cliente' => fake()->phoneNumber(),
                'direccion_cliente_escrita' => fake()->address(),
                'direccion_cliente_ubicacion' => 'https://maps.google.com/?q=' .fake()->latitude() . ',' . fake()->longitude(),
                'order_referencia' => strtoupper(fake()->bothify('????####')),
                'total' => rand(300, 600), 
            ]);

            $order->productos()->attach([
                rand(1, 10) => ['cantidad' => rand(1, 3)],
                rand(1, 10) => ['cantidad' => rand(1, 3)],
            ]);
        }
    }
}
