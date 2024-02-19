<?php
// File: database/factories/SkillFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Skill;
use Faker\Generator as Faker;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(3),
            // Other properties if any
        ];
    }
}
