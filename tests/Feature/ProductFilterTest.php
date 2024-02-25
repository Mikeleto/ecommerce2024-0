<?php

namespace Tests\Feature\Livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Product;
use App\Http\Livewire\Admin\Link;
use Laravel\Jetstream\Features;
use Tests\CreateData;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterTest extends TestCase
{
    use RefreshDatabase, CreateData;

   /** @test */
public function it_can_filter_products_by_color()
{
    $category = $this->createCategory();
    $subcategory = $this->createSubcategory($category);
    $brand = $this->createBrand($category);
  
    $product = $this->createProduct($subcategory, $brand);

    Livewire::test(Link::class)
        ->assertSee($product->name);
}
}