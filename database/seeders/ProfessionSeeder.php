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
                'user_id' => 1,
                'education_level' => 'Bachillerato',
                'salary' => 3000,
                'sector' => 'Salud',
                'experience_required' => 5,
            ],
            [
                'title' => 'Desarrollador front-end',
                'user_id' => 2,
                'education_level' => 'Bachillerato',
                'salary' => 3000,
                'sector' => 'Salud',
                'experience_required' => 5,
            ],
            [
                'title' => 'Desarrollador full stack',
                'user_id' => 3,
                'education_level' => 'Bachillerato',
                'salary' => 3000,
                'sector' => 'Salud',
                'experience_required' => 5,
            ],
          
        ];

        foreach ($professions as $profession)
        {
            Profession::create($profession);
        }
    }
}
