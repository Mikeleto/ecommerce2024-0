<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class PruebaTest extends TestCase {
     /** @test */
     public function product_test()
     {
         // Crea un producto utilizando la factory
         $producto = factory(Product::class)->create();
 
         // Renderiza el componente Livewire y pasa el producto como parámetro
         Livewire::test(NombreDelComponente::class, ['producto' => $producto])
             ->assertSee($producto->name); // Ajusta esto según la estructura de tu modelo
 
         // Puedes realizar más assertions según tus necesidades...
     }

     
 
}