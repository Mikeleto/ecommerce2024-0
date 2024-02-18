<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      
        $this->fetchRelations();
        $this->createUser();
        $this->createAdminUser();
        $this->createOtherUser();

    }
    
    private function fetchRelations()
    {
        $this->professions = Profession::all();
    }

    private function createUser(){
        User::factory()->create([
            'id' => 1,
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
            'profession' => 'Desarrollador back-end',
        
        ]);
    }

    private function createAdminUser(){
        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'id' => 2,
            'name' => 'Antoniardo',
            'email' => 'prueba@gmail.com',
            'password' => bcrypt('12345678'),
            'profession' => 'Desarrollador front-end',
      
        ])->assignRole('admin');
    }

    private function createOtherUser(){
        User::factory()->create([
            'id' => 3,
            'name' => 'Rayo',
            'email' => 'rayo@test.com',
            'profession' => 'Desarrollador full stack',
        
        ]);
    }
}
