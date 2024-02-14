<?php

namespace Database\Seeders;
use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
            [
                'name' => 'Desarrollador back-end',
            ],
            [
                'name' => 'Desarrollador front-end',
            ],
            [
                'name' => 'Desarrollador full stack',
            ],
            [
                'name' => 'Ingeniero',
            ],
            [
                'name' => 'Pizzero',

            ],
            [
                'name' => 'Autonomo',
              
            ],
          
        ];

        foreach ($professions as $profession)
        {
            Profession::create($profession);
        }
    }
}
