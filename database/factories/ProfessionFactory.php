<?php
namespace Database\Factories;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profession;
use App\Models\Skill;

class ProfessionFactory extends Factory
{
    protected $model = Profession::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Profession $profession) {
            // Generar entre 0 y 3 habilidades
            $skills = Skill::inRandomOrder()->limit(rand(0, 3))->get();
            $profession->skills()->attach($skills);
        });
    }
}