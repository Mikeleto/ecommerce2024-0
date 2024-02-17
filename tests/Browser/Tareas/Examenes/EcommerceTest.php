<?php

namespace Tests\Browser\Tareas\Examenes;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use App\Models\Size;
use Database\Factories\SizeFactory;
use Facebook\WebDriver\WebDriverKeys;
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

class EcommerceTest extends DuskTestCase
{
    use DatabaseMigrations;

    /*
    * A basic browser test example.
    *
    * @return void
    */

    protected function setUp(): void{

        parent::setUp();
    
        $brand = Brand::factory()->create();
        $brand2 = Brand::factory()->create();
    
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category2 = Category::factory()->create([
            'name' => 'categoria2',
            'slug' => 'categoria2',
            'icon' => 'categoria2',
        ]);
      
        $category->brands()->attach($brand->id);
        $category2->brands()->attach($brand2->id);
       
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
          
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category2->id,
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
            'price' =>'49.99',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 10,
            'name' => 'algo2',
            'slug' => 'algo2',
            'price' => '19.99'
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
     
    }
    public function test_compras() {
        $brand = Brand::factory()->create();
        $brand2 = Brand::factory()->create();
    
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category2 = Category::factory()->create([
            'name' => 'categoria2',
            'slug' => 'categoria2',
            'icon' => 'categoria2',
        ]);
      
        $category->brands()->attach($brand->id);
        $category2->brands()->attach($brand2->id);
       
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
        ]);
        $subcategory2 = Subcategory::factory()->create([
            'category_id' => $category2->id,
            'name' => 'tele',
            'slug' => 'tele',
        ]);

        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 10,
            'name' => 'algo1',
            'slug' => 'algo1',
            'price' => '49.99',
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory2->id,
            'quantity' => 10,
            'name' => 'algo2',
            'slug' => 'algo2',
            'price' => '19.99',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Rubén',
            'email' => 'algo1234@gmail.com',
            'password' => bcrypt('algo1234')
        ])->assignRole('admin');
        $this->browse(function (Browser $browser) use($usuario , $p1,$p2) {
            $browser ->loginAs($usuario)
                ->visit('/products/'.$p1->name)
                ->pause(300)
                ->screenshot('compras')
                ->click('@buy')
                ->pause(300)
                ->screenshot('compras2')
                ->visit('/products/'.$p2->name)
                ->pause(300)
                ->screenshot('compras3')
                ->click('@buy')
                ->pause(300)
                ->screenshot('compras4')
                ->click('@carrito')
                ->pause(300)
                ->visit('/shopping-cart')
                ->pause(300)
                ->assertSee('algo1')
                ->assertSee('algo2')
                ->assertSee('49.99')
                ->assertSee('19.99')
                ->assertSee('69.98')
                ->screenshot('compras5')
                ->click('@perfilLogued')
                ->pause(600)
                ->screenshot('compras6')
                ->click('@logout')
                ->pause(600)
                ->visit('/login')
                ->pause(500)
                ->type('email' , 'algo1234@gmail.com')
                ->type('password', 'algo1234')
                ->pause(500)
                ->screenshot('compras7')
                ->click('@loginAs')
                ->pause(600)
                ->screenshot('compras8')
                ->visit('/shopping-cart')
                ->pause(300)
                ->assertSee('algo1')
                ->assertSee('algo2')
                ->assertSee('49.99')
                ->assertSee('19.99')
                ->assertSee('69.98')
                ->screenshot('compras9');
        });
    }

    public function test_dobleFiltro() {
       
        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Rubén',
            'email' => 'algo1234@gmail.com',
            'password' => bcrypt('algo1234')
        ])->assignRole('admin');
        $usuario2 = User::factory()->create([
            'name' => 'aaaaa',
            'email' => 'algo12346@gmail.com',
            'password' => bcrypt('algo12346')
        ]);
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
        $this->browse(function (Browser $browser) use ($usuario, $usuario2) {
            $browser->loginAs($usuario)
                ->visit('admin/link')
                ->pause(300)
                ->screenshot('dobleFiltro')
                ->type('@nameFilter', 'algo2')
                ->pause(500)
                ->select('#brandSelect',2)
                ->pause(500)
                ->screenshot('dobleFiltro-1')
                ->select('#colorSelect',2)
                ->pause(500)
                ->assertSee('No existen productos coincidentes')
                ->screenshot('dobleFiltro-2');
        });
    }

    public function test_prueba3() {
       
        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Rubén',
            'email' => 'algo1234@gmail.com',
            'password' => bcrypt('algo1234')
        ])->assignRole('admin');
        $usuario2 = User::factory()->create([
            'name' => 'aaaaa',
            'email' => 'algo12346@gmail.com',
            'password' => bcrypt('algo12346')
        ]);
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
        $this->browse(function (Browser $browser) use ($usuario, $usuario2) {
            $browser->loginAs($usuario)
                ->visit('admin/link')
                ->pause(300)
                ->click('@columnas')
                ->pause(500)
                ->click('@nombreCheck')
                ->pause(500)
                ->assertDontSee('NOMBRE')
                ->screenshot('prueba3');
        });
    }

    public function test_papelera() {
       
        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Rubén',
            'email' => 'algo1234@gmail.com',
            'password' => bcrypt('algo1234')
        ])->assignRole('admin');
        $usuario2 = User::factory()->create([
            'name' => 'aaaaa',
            'email' => 'algo12346@gmail.com',
            'password' => bcrypt('algo12346')
        ]);
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
        $this->browse(function (Browser $browser) use ($usuario, $usuario2) {
            $browser->loginAs($usuario)
                ->visit('admin/users')
                ->pause(300)
                ->screenshot('papelera');
        });
    }


  


}