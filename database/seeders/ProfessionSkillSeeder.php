<?php

namespace Database\Seeders;

use App\Models\Profession;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class ProfessionSkillSeeder extends Seeder
{
    public function run()
    {
        // Obtener algunas profesiones y habilidades
        $profession1 = Profession::find(1);
        $profession2 = Profession::find(2);
        $profession3 = Profession::find(3);
        $profession4 = Profession::find(4);
        $profession5 = Profession::find(5);
        $profession6 = Profession::find(6);
        $profession7 = Profession::find(7);
        $profession8 = Profession::find(8);
        $profession9 = Profession::find(9);
        $profession10 = Profession::find(10);

        $skillHTML = Skill::where('name', 'HTML')->first();
        $skillCSS = Skill::where('name', 'CSS')->first();
        $skillJS = Skill::where('name', 'JS')->first();
        $skillPHP = Skill::where('name', 'PHP')->first();
        $skillSQL = Skill::where('name', 'SQL')->first();
        $skillPOO = Skill::where('name', 'POO')->first();
        $skillTDD = Skill::where('name', 'TDD')->first();

        // Asignar habilidades a las profesiones
        $profession1->skills()->attach([$skillHTML->id]);
        $profession2->skills()->attach([$skillCSS->id]);
        $profession3->skills()->attach([$skillJS->id]);
        $profession4->skills()->attach([$skillPHP->id]);
        $profession5->skills()->attach([$skillSQL->id]);
        $profession6->skills()->attach([$skillPOO->id]);
        $profession7->skills()->attach([$skillTDD->id]);
        $profession8->skills()->attach([$skillJS->id]);
        $profession9->skills()->attach([$skillTDD->id]);
        $profession10->skills()->attach([$skillHTML->id]);

        // Puedes continuar asignando más relaciones según tus necesidades
    }
}