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

class LaratddTest extends DuskTestCase
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
            'color' => true,
            'size' => true
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
     
    }
    public function test_bio_twitter() {
        $this->browse(function (Browser $browser) {
            $browser->visit('register')
                ->pause(300)
                ->screenshot('bio_twitter_1')
                ->type('name','algo1')
                ->pause(300)
                ->type('email','email@gmail.com')
                ->pause(300)
                ->type('password','12345678')
                ->pause(300)
                ->type('password_confirmation','12345678')
                ->pause(300)
                ->type('bio','pipas')
                ->pause(300)
                ->type('twitter','https://www.youtube.com/watch?v=sWtEYPva4A0&t=3962s')
                ->pause(300)
                ->screenshot('bio_twitter_2')
                ->press('REGISTRARSE')
                ->pause(300)
                ->screenshot('bio_twitter_3');
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