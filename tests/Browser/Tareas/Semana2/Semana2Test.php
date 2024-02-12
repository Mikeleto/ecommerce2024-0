<?php

namespace Tests\Browser\Tareas\Semana2;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Image;
use App\Models\Subcategory;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Semana2Test extends DuskTestCase
{
    use DatabaseMigrations;

    /*
    * A basic browser test example.
    *
    * @return void
    */

      protected function setUp(): void{

        parent::setUp();
    
        $this->category = Category::factory()->create([
            'name' => 'INFORMATICA',
            'slug' => 'INFORMATICA',
            'icon' => '->',
        ]);
        $this->subcategory = Subcategory::factory()->create([
            'name' => 'INFORMATICA',
            'slug' => 'INFORMATICA',
            'icon' => '->',
        ]);

        $this->role = Role::create(['name' => 'admin']);
        $this->user = User::factory()->create([
            'name' => 'mike',
            'email' => 'pococho@gmail.com',
            'password' => bcrypt('poco1234')
        ])->assignRole('admin');
    }
    public function test_s2_tarea1() {
 
       
        $this->browse(function (Browser $browser) {
         $browser->visit('/')
         ->pause(500)
            ->assertSee('Categorías')
            ->click('@categorias')
            ->pause(500)
            ->screenshot('purbana');
            
        });
    }

    public function test_s2_tarea2(){
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'casa',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'interior',
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'exterior',
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $p4 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'cocina',
        ]);
        Image::factory()->create([
            'imageable_id' => $p4->id,
            'imageable_type' => Product::class
        ]);
        $p5 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'habitaciones',
        ]);
        Image::factory()->create([
            'imageable_id' => $p5->id,
            'imageable_type' => Product::class
        ]);
        $this->browse(function (Browser $browser){
            $browser->visit('/')
            ->pause(500)
            ->assertSee('casa')
            ->assertSee('interior')
            ->assertSee('exterior')
            ->assertSee('cocina')
            ->assertSee('habitaciones')
            ->screenshot('s2-2');
        });
    }

    public function test_s2_tarea3(){
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'casa',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'interior',
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        $p3 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'exterior',
        ]);
        Image::factory()->create([
            'imageable_id' => $p3->id,
            'imageable_type' => Product::class
        ]);
        $p4 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'cocina',
        ]);
        Image::factory()->create([
            'imageable_id' => $p4->id,
            'imageable_type' => Product::class
        ]);
        $p5 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'habitaciones',
        ]);
        Image::factory()->create([
            'imageable_id' => $p5->id,
            'imageable_type' => Product::class
        ]);
        $p6 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'status' => 1,
            'name' => 'habitaciones',
        ]);
        Image::factory()->create([
            'imageable_id' => $p5->id,
            'imageable_type' => Product::class
        ]);
        $this->browse(function (Browser $browser){
            $browser->visit('/')
            ->pause(500)
            ->assertSee('casa')
            ->assertSee('interior')
            ->assertSee('exterior')
            ->assertSee('cocina')
            ->assertSee('habitaciones')
            ->assertDontSee('patio')
            ->screenshot('s2-3');
        });
    }
    public function test_s2_tarea4() {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'casa',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'coche',
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        $this->browse(function (Browser $browser) use ($category) {
            $browser->visit('/categories/' . $category->slug)
                ->pause(600)
                ->assertSee('Subcategorías')
                ->assertSee('Marcas')
                ->assertSee('casa')
                ->assertSee('coche')
                ->screenshot('s2-4');
        });
    }

    public function test_s2_tarea5() {
        $brand = Brand::factory()->create([
            'name' => 'marca',
        ]);
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'casa',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $p2 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'coche',
        ]);
        Image::factory()->create([
            'imageable_id' => $p2->id,
            'imageable_type' => Product::class
        ]);
        $this->browse(function (Browser $browser) use ($category, $subcategory, $brand) {
            $browser->visit('/categories/' . $category->slug)
                ->pause(600)
                ->assertSee('Subcategorías')
                ->assertSee('Marcas')
                ->assertSee('casa')
                ->assertSee('coche')
                ->screenshot('s2-5-1')
                ->clickLink($subcategory->name)
                ->pause(500)
                ->screenshot('s2-5-2')
                ->clickLink($brand->name)
                ->pause(500)
                ->screenshot('s2-5-3')
                ;
        });
    }


    public function test_s2_tarea6() {
        $brand = Brand::factory()->create([
            'name' => 'marca',
        ]);
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'casa',
            'slug' => 'casa',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $this->browse(function (Browser $browser) use ($p1) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('casa')
                ->screenshot('s2-6-1');
        });
    }

    public function test_s2_tarea7() {
        $brand = Brand::factory()->create([
            'name' => 'marca',
        ]);
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'casa',
            'slug' => 'casa',
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $this->browse(function (Browser $browser) use ($p1) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee($p1->description)
                ->assertSee($p1->name)
                ->assertSee($p1->price)
                ->assertSee($p1->quantity)
                ->assertSee($p1->description)
                ->screenshot('s2-7');
        });
    }

    public function test_s2_tarea8() {
        $brand = Brand::factory()->create([
            'name' => 'marca',
        ]);
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'casa',
            'slug' => 'casa',
            'quantity' => 2,
        ]);
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $this->browse(function (Browser $browser) use ($p1) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->screenshot('s2-8-1')
                ->press('+')
                ->pause(600)
                ->assertSee(2)
                ->screenshot('s2-8-2')
                ->press('-')
                ->pause(600)
                ->assertSee(1)
                ->screenshot('s2-8-3');
        });
    }

    public function test_s2_tarea9() {
        $brand = Brand::factory()->create([
            'name' => 'marca',
        ]);
        $category = Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);
        $category->brands()->attach($brand->id);
        $subcategory = Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'subcategoria',
            'slug' => 'subcategoria',
            'color' => true,
            'size' => true
        ]);
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'name' => 'casa',
            'slug' => 'casa',
            'quantity' => 2,
        ]);
        $image = Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
        $this->browse(function (Browser $browser) use ($p1, $category, $subcategory, $brand , $image) {
            $browser->visit('/products/' . $p1->name)
                ->pause(600)
                ->assertSee('Seleccione una talla')
                ->assertSee('Seleccione un color')
                ->screenshot('s2-9-1')
                ->click('@talla')
                ->pause(600)
                ->screenshot('s2-9-2')
                ->click('@color')
                ->pause(600)
                ->screenshot('s2-9-3');
        });
    }


    

}