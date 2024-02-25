<?php

namespace Database\Seeders;

use App\Models\Profession;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class ProfessionSkillSeeder extends Seeder
{
    public function run()
    {
      
        $professions = Profession::all();
        $skills = Skill::all();

        foreach ($professions as $profession) {
           
            $numberOfSkills = rand(0, 3);
            $randomSkills = $skills->random($numberOfSkills);
            $profession->skills()->attach($randomSkills->pluck('id')->toArray());
        }
    }
}