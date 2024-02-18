<?php

namespace Tests\Browser\Tareas\Examenes;


use Database\Factories\SizeFactory;
use Facebook\WebDriver\WebDriverKeys;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Log;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Spatie\Permission\Models\Role;

use App\Models\User;
use App\Models\Profession;

class TddLaraTest extends DuskTestCase
{
    use DatabaseMigrations;

    /*
    * A basic browser test example.
    *
    * @return void
    */

    protected function setUp(): void{

        parent::setUp();
    
       
       
     
    }
    public function test_profesion1() {

        $profession1 = Profession::factory()->create([
            'title' => 'Trabajador',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);
        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Rubén',
            'email' => 'algo1234@gmail.com',
            'password' => bcrypt('algo1234')
        ])->assignRole('admin');
    
        $this->browse(function (Browser $browser) use ($usuario,$profession1) {
            $browser->loginAs($usuario)
                ->visit('admin/professions')
                ->pause(300)
                ->assertSee('Lista de profesiones')
                ->screenshot('profesion-1');
        });
    }

    public function test_profesion2() {

        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Rubén',
            'email' => 'algo1234@gmail.com',
            'password' => bcrypt('algo1234')
        ])->assignRole('admin');
    
        $this->browse(function (Browser $browser) use ($usuario) {
            $browser->loginAs($usuario)
                ->visit('admin/professions')
                ->pause(300)
                ->assertSee('No existen profesiones coincidentes')
                ->screenshot('profesion-2');
        });
    }

    public function test_profesion3() {

        $profession1 = Profession::factory()->create([
            'title' => 'Trabajador',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession2 = Profession::factory()->create([
            'title' => 'Talador',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession3 = Profession::factory()->create([
            'title' => 'Misionera',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession4 = Profession::factory()->create([
            'title' => 'Musico',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession5 = Profession::factory()->create([
            'title' => 'Dormir',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession6 = Profession::factory()->create([
            'title' => 'Sweet',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession7 = Profession::factory()->create([
            'title' => 'Hola',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession8 = Profession::factory()->create([
            'title' => 'Adios',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession9 = Profession::factory()->create([
            'title' => 'Perro',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession10 = Profession::factory()->create([
            'title' => 'Gato',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession11 = Profession::factory()->create([
            'title' => 'Caballo',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

    

        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Rubén',
            'email' => 'algo1234@gmail.com',
            'password' => bcrypt('algo1234')
        ])->assignRole('admin');
    
        $this->browse(function (Browser $browser) use ($usuario,$profession1,$profession2,$profession3,$profession4,$profession5,$profession6,$profession7,$profession8,$profession9,$profession10,$profession11) {
            $browser->loginAs($usuario)
                ->visit('admin/professions')
                ->pause(300)
                ->assertSee('Mostrando 1 al 10')
                ->screenshot('profesion-3');
        });
    }


    public function test_profesion4() {

        $profession1 = Profession::factory()->create([
            'title' => 'Trabajador',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession2 = Profession::factory()->create([
            'title' => 'Arquitecta',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $profession3 = Profession::factory()->create([
            'title' => 'Misionera',
            'description' => 'categoria',
            'education_level' => 'Bachillerato',
            'salary' => 3000,
            'sector' => 'Finanzas',
            'experience_required' => 11,
        ]);

        $role = Role::create(['name' => 'admin']);
        $usuario = User::factory()->create([
            'name' => 'Rubén',
            'email' => 'algo1234@gmail.com',
            'password' => bcrypt('algo1234')
        ])->assignRole('admin');
    
        $this->browse(function (Browser $browser) use ($usuario,$profession1,$profession2,$profession3) {
            $browser->loginAs($usuario)
                ->visit('admin/professions')
                ->pause(300)
                ->screenshot('profesion-4');
        });
    }


   
  


}