<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
        ]);
        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Antoniardo',
            'email' => 'prueba@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');

    }
}
