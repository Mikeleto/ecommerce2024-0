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
                'title' => 'Desarrollador back-end',
                'education_level' => 'Bachillerato',
                'salary' => 3000,
                'sector' => 'Salud',
                'experience_required' => 5,
            ],
            [
                'title' => 'Desarrollador front-end',
                'education_level' => 'Bachillerato',
                'salary' => 3000,
                'sector' => 'Salud',
                'experience_required' => 5,
            ],
            [
                'title' => 'Desarrollador full stack',
                'education_level' => 'Bachillerato',
                'salary' => 3000,
                'sector' => 'Salud',
                'experience_required' => 5,
            ],
         
        ];

        foreach ($professions as $profession) {
            Profession::create($profession);
        }

       
        Profession::factory(100)->create();
    }
}