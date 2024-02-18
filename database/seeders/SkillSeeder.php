<?php

namespace Database\Seeders;
use App\Models\Skill;
use Illuminate\Database\Seeder;
class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $skills = [
            [
            'name' => 'HTML',
            ],
            [
                'name' => 'CSS',
            ],
            [
                'name' => 'JS',
            ],
            [
                'name' => 'PHP',
            ],
            [
                'name' => 'SQL',
            ],
            [
                'name' => 'POO',
            ],
            [
                'name' => 'TDD',
            ],
            
          
        ];

        foreach ($skills as $skill)
        {
            Skill::create($skill);
        }
    }
    
}
