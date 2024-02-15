<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ColorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::whereHas('subcategory', function($query){
            $query->where('color', true)
                ->where('size', false);
        })->get();

        $colors = Color::all();

        foreach ($products as $product) {
            $colorQuantities = [];

            // Obtener una lista aleatoria de colores para este producto
            $randomColors = $colors->random(rand(1, count($colors)));

            foreach ($randomColors as $color) {
                $colorQuantities[$color->id] = ['quantity' => rand(0, 20)]; // ajusta el rango según tus necesidades
            }

            $product->colors()->attach($colorQuantities);
        }
    }
}