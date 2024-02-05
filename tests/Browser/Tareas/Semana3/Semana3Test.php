<?php

namespace Tests\Browser\Tareas\Semana3;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use App\Models\Size;
use Database\Factories\SizeFactory;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Log;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Spatie\Permission\Models\Role;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
class Semana3Test extends DuskTestCase
{
    use DatabaseMigrations;

    /*
    * A basic browser test example.
    *
    * @return void
    */
    public function test_s3_tarea1() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 2,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 2,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 2,
            'name' => 'algo3',
            'slug' => 'algo3',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 10],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 10
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->screenshot('s3-1-0')
                ->assertSee('Seleccione un color')
                ->assertSee('Seleccione una talla')
                ->select('#talla3', 1)
                ->pause(600)
                ->screenshot('s3-1-1')
                ->select('#color3', 1)
                ->pause(600)
                ->screenshot('s3-1-2')
                ->click('@comprar')
                ->pause(600)
                ->screenshot('s3-1-3')
                
                ->visit('/products/' . $p2->name)
                ->pause(600)
                ->assertSee('Stock disponible')
                ->screenshot('s3-1-4')
                ->click('@buy')
                ->pause(600)
                ->screenshot('s3-1-5')

                ->visit('/products/' . $p3->name)
                ->pause(600)
                ->assertSee('Seleccionar un color')
                ->screenshot('s3-1-6')
                ->select('#onlyColor', 1)
                ->pause(600)
                ->screenshot('s3-1-7')
                ->click('@comprarColor')
                ->pause(600)
                ->screenshot('s3-1-8');
        });
    }

    public function test_s3_tarea2() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 2,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 2,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 2,
            'name' => 'algo3',
            'slug' => 'algo3',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 10],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 10
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('Seleccione un color')
                ->assertSee('Seleccione una talla')
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
              
                
                ->visit('/products/' . $p2->name)
                ->pause(600)
                ->assertSee('Stock disponible')
                ->click('@buy')
                ->pause(600)
        
                ->visit('/products/' . $p3->name)
                ->pause(600)
                ->assertSee('Seleccionar un color')
                ->select('#onlyColor', 1)
                ->pause(600)
                ->click('@comprarColor')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->screenshot('s3-2-1')
                ->click('@carrito')
                ->pause(600)
                ->screenshot('s3-2-2')
                ;
        });
    }

    public function test_s3_tarea3() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $subcategory4 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 2,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 2,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 2,
            'name' => 'algo3',
            'slug' => 'algo3',
        ]);
        $p4 = Product::factory()->create([
            'subcategory_id' => $subcategory4->id,
            'quantity' => 2,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p4->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 10],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 10
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $p4, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('Seleccione un color')
                ->assertSee('Seleccione una talla')
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
              
                
                ->visit('/products/' . $p2->name)
                ->pause(600)
                ->assertSee('Stock disponible')
                ->click('@buy')
                ->pause(600)
        
                ->visit('/products/' . $p3->name)
                ->pause(600)
                ->assertSee('Seleccionar un color')
                ->select('#onlyColor', 1)
                ->pause(600)
                ->click('@comprarColor')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->screenshot('s3-3-1')
                ->assertSee('3')

                ->visit('/products/' . $p4->name)
                ->pause(600)
                ->assertSee('Stock disponible')
                ->click('@buy')
                ->pause(600)
                ->screenshot('s3-3-2')
                ->assertSee('4')
               
            
                ;
        });
    }

    public function test_s3_tarea4() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 1,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 1,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 1,
            'name' => 'algo3',
            'slug' => 'algo3',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 1],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 1
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('Seleccione un color')
                ->assertSee('Seleccione una talla')
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
              
                
                ->visit('/products/' . $p2->name)
                ->pause(600)
                ->assertSee('Stock disponible')
                ->click('@buy')
                ->pause(600)
        
                ->visit('/products/' . $p3->name)
                ->pause(600)
                ->assertSee('Seleccionar un color')
                ->select('#onlyColor', 1)
                ->pause(600)
                ->click('@comprarColor')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->screenshot('s3-4-1')
                ->click('@carrito')
                ->pause(600)
                ->screenshot('s3-4-2')
                ->click('@carritoCompras')
                ->pause(600)
                ->screenshot('s3-4-3')
                ;
        });
    }


    public function test_s3_tarea5() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 10,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 10,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 10,
            'name' => 'algo3',
            'slug' => 'algo3',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 10],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 10
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
               
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->screenshot('s3-5-1')
                ->assertSee(10)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
                ->assertSee(9)
                ->screenshot('s3-5-2')
              
                
                ->visit('/products/' . $p2->name)
                ->pause(600)
                ->assertSee(10)
                ->screenshot('s3-5-3')
                ->click('@buy')
                ->assertSee(9)
                ->screenshot('s3-5-4')
                ->pause(600)
        
                ->visit('/products/' . $p3->name)
                ->pause(600)
                ->select('#onlyColor', 1)
                ->pause(600)
                ->assertSee(10)
                ->screenshot('s3-5-5')
                ->click('@comprarColor')
                ->assertSee(9)
                ->screenshot('s3-5-6')
                ->pause(600);
        });
    }

    public function test_s3_tarea6() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 10,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 10,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 10,
            'name' => 'algo3',
            'slug' => 'algo3',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 10],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 10
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/')
            ->pause(600)
            ->type('name' , 'algo1')
            ->pause(600)
            ->screenshot('s3-6-1')
            ->click('@buscar')
            ->pause(600)
            ->assertSee('algo1')
            ->screenshot('s3-6-2')
            ->type('name', '')
            ->pause(600)
            ->click('@buscar')
            ->assertSee('algo1', 'algo2', 'algo3')
            ->screenshot('s3-6-3');               
        });
    }


    public function test_s3_tarea7() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 1,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 1,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 1,
            'name' => 'algo3',
            'slug' => 'algo3',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 1],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 1
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('Seleccione un color')
                ->assertSee('Seleccione una talla')
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
              
                
                ->visit('/products/' . $p2->name)
                ->pause(600)
                ->assertSee('Stock disponible')
                ->click('@buy')
                ->pause(600)
        
                ->visit('/products/' . $p3->name)
                ->pause(600)
                ->assertSee('Seleccionar un color')
                ->select('#onlyColor', 1)
                ->pause(600)
                ->click('@comprarColor')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->screenshot('s3-7-1')
                ->click('@carrito')
                ->pause(600)
                ->screenshot('s3-7-2')
                ->click('@carritoCompras')
                ->pause(600)
                ->screenshot('s3-7-3')
                ;
        });
    }

    public function test_s3_tarea8() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 10,
            'name' => 'algo1',
            'slug' => 'algo1',
            'price' => '20.99',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 10,
            'name' => 'algo2',
            'slug' => 'algo2',
            'price' => '15.99',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 10,
            'name' => 'algo3',
            'slug' => 'algo3',
            'price' => '19.99'
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 10],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 10
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
              
                
                ->visit('/products/' . $p2->name)
                ->pause(600)
                ->assertSee('Stock disponible')
                ->click('@buy')
                ->pause(600)
        
                ->visit('/products/' . $p3->name)
                ->pause(600)
                ->assertSee('Seleccionar un color')
                ->select('#onlyColor', 1)
                ->pause(600)
                ->click('@comprarColor')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->click('@carrito')
                ->pause(600)
                ->assertSee(56,97)
                ->assertSee(1)
                ->click('@carritoCompras')
                ->pause(600)
                ->screenshot('s3-8-1')
                ->click('@sumar')
                ->pause(600)
                ->assertSee(2)
                ->assertSee(77,96)
                ->screenshot('s3-8-2')
                ;
        });
    }

    public function test_s3_tarea9() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 1,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 1,
            'name' => 'algo2',
            'slug' => 'algo2',
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory3->id,
            'quantity' => 1,
            'name' => 'algo3',
            'slug' => 'algo3',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 1],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 1
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($p1,$p2,$p3, $category, $subcategory,$subcategory2,$subcategory3, $brand) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
              
                
                ->visit('/products/' . $p2->name)
                ->pause(600)
                ->click('@buy')
                ->pause(600)
        
                ->visit('/products/' . $p3->name)
                ->pause(600)
                ->select('#onlyColor', 1)
                ->pause(600)
                ->click('@comprarColor')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->click('@carrito')
                ->pause(600)
                ->click('@carritoCompras')
                ->pause(600)
                ->assertSee('algo1','algo2','algo3')
                ->screenshot('s3-9-1')
                ->click('@borrarProducto')
                ->pause(600)
                ->assertSee('algo2','algo3')
                ->screenshot('s3-9-2')
                ->click('@borrarCarrito')
                ->pause(600)
                ->assertSee('TU CARRITO DE COMPRAS ESTÁ VACÍO')
                ->screenshot('s3-9-3')
                ;
        });
    }

    public function test_s3_tarea10() {
        $role = Role::create(['name' => 'user']);
        $user = User::factory()->create([
            'name' => 'mike',
            'email' => 'pococho@gmail.com',
            'password' => bcrypt('poco1234')
        ])->assignRole('user');
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 1,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 1],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 1
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($user,$p1 ,$category, $subcategory,$brand) {
            $browser->loginAS($user)
                ->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('Seleccione un color')
                ->assertSee('Seleccione una talla')
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->click('@carrito')
                ->pause(600)
                ->click('@carritoCompras')
                ->pause(600)
                ->screenshot('s3-10-1')
                ->click('@continuar')
                ->pause(600)
                ->screenshot('s3-10-2')

                ;
        });
    }

    public function test_s3_tarea11() {
        $role = Role::create(['name' => 'user']);
        $user = User::factory()->create([
            'name' => 'mike',
            'email' => 'pococho@gmail.com',
            'password' => bcrypt('poco1234')
        ])->assignRole('user');
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 1,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 1],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 1
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($user,$p1 ,$category, $subcategory,$brand) {
            $browser->loginAS($user)
                ->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('Seleccione un color')
                ->assertSee('Seleccione una talla')
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->click('@carrito')
                ->pause(600)
                ->click('@carritoCompras')
                ->pause(600)
                ->click('@continuar')
                ->pause(600)
                ->assertSee('algo1')
                ->click('@perfilLogued')
                ->pause(600)
                ->screenshot('s3-11-1')
                ->click('@logout')
                ->pause(600)
                ->screenshot('s3-11-2')

                ->visit('/login')
                ->pause(500)
                ->type('email' , 'pococho@gmail.com')
                ->type('password', 'poco1234')
                ->pause(500)
                ->screenshot('s3-11-3')
                ->click('@loginAs')
                ->pause(600)
                ->assertSee('algo1')
                ->screenshot('s3-11-4')

          
                
                ;
        });
    }

    public function test_s3_tarea12() {
        $role = Role::create(['name' => 'user']);
        $user = User::factory()->create([
            'name' => 'mike',
            'email' => 'pococho@gmail.com',
            'password' => bcrypt('poco1234')
        ])->assignRole('user');
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 1,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 1],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 1
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($user,$p1 ,$category, $subcategory,$brand) {
            $browser->loginAS($user)
                ->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('Seleccione un color')
                ->assertSee('Seleccione una talla')
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->click('@carrito')
                ->pause(600)
                ->click('@carritoCompras')
                ->pause(600)
                ->click('@continuar')
                ->pause(600)
                ->screenshot('s3-12-1')
                ->click('@domicilio')
                ->pause(600)
                ->assertSee('Departamento')
                ->screenshot('s3-12-2')
                ->click('@puntoDeRecogida')
                ->pause(600)
                ->assertDontSee('Departamento')
                ->screenshot('s3-12-3')

                ;
        });
    }

    public function test_s3_tarea13() {
        
        $role = Role::create(['name' => 'user']);
        $user = User::factory()->create([
            'name' => 'mike',
            'email' => 'pococho@gmail.com',
            'password' => bcrypt('poco1234')
        ])->assignRole('user');
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 1,
            'name' => 'algo1',
            'slug' => 'algo1',
            'price' => '15.99',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $department = Department::create(['name' => 'casa']);
        $city = City::create(['name' => 'murcia',
    'department_id' => $department->id,
    'cost' => '15.99']);
        $districts = District::create(['name' => 'avellana',
                'city_id' => $city->id]);
      
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 1],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 1
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($user,$p1 ,$category, $subcategory,$city,$department,$districts) {
            $browser->loginAS($user)
                ->visit('/products/' . $p1->name)
                ->pause(600)
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->click('@carrito')
                ->pause(600)
                ->click('@carritoCompras')
                ->pause(600)
                ->click('@continuar')
                ->pause(600)
                ->screenshot('s3-13-1')
                ->type('@phone', '956789987')
                ->type('@contact', 'mike')
                ->pause(600)
                ->screenshot('s3-13-2')
                ->click('@continue')
                ->pause(600)
                ->screenshot('s3-13-3')
                ->click('@carrito')
                ->pause(600)
                ->assertSee('No tiene agregado ningún item en el carrito')
                ->screenshot('s3-13-4')
              

                ;
        });
    }


    public function test_s3_tarea14() {
        
        $role = Role::create(['name' => 'user']);
        $user = User::factory()->create([
            'name' => 'mike',
            'email' => 'pococho@gmail.com',
            'password' => bcrypt('poco1234')
        ])->assignRole('user');
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => true,
            'size' => true
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);
        $subcategory3 = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'movil',
            'slug' => 'movil',
            'color' => true,
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 1,
            'name' => 'algo1',
            'slug' => 'algo1',
            'price' => '15.99',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $department = Department::create(['name' => 'casa']);
        $city = City::create(['name' => 'murcia',
    'department_id' => $department->id,
    'cost' => '15.99']);
        $districts = District::create(['name' => 'avellana',
                'city_id' => $city->id]);
      
        $size = Size::factory()->create([
            'name' => 'Talla M',
            'product_id' => $p1->id,
        ]);
        $colors = ['azul'];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
        $sizes = Size::all();
        foreach ($sizes as $size) {
            $size->colors()
                ->attach([
                    1 => ['quantity' => 1],
                ]);
        }
        $products = Product::whereHas('subcategory', function (Builder $query) {
            $query->where('color', true)
                ->where('size', false);
        })->get();
        foreach ($products as $product) {
            $product->colors()->attach([
                1 => [
                    'quantity' => 1
                ],
            ]);
        }
        $this->browse(function (Browser $browser) use ($user,$p1 ,$category, $subcategory,$city,$department,$districts) {
            $browser->loginAS($user)
                ->visit('/products/' . $p1->name)
                ->pause(600)
                ->select('#talla3', 1)
                ->pause(600)
                ->select('#color3', 1)
                ->pause(600)
                ->click('@comprar')
                ->pause(600)
                
                ->visit('/')
                ->pause(600)
                ->click('@carrito')
                ->pause(600)
                ->click('@carritoCompras')
                ->pause(600)
                ->click('@continuar')
                ->pause(600)
                ->screenshot('s3-14-1')
                ->type('@phone', '956789987')
                ->type('@contact', 'mike')
                ->pause(600)
                ->screenshot('s3-14-2')
                ->click('@continue')
                ->pause(600)
                ->screenshot('s3-14-3')
                ->click('@carrito')
                ->pause(600)
                ->assertSee('No tiene agregado ningún item en el carrito')
                ->screenshot('s3-14-4')
              

                ;
        });
    }

}

