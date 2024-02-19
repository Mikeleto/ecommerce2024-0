<?php

namespace App\Http\Livewire\Admin;

use App\Models\Profession;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProfession extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 10;
    public $nameFilter;
    public $sortBy = 'title';
    public $sortDirection = 'asc';
    public $selectedSkills = [];

    public function sortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $column;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Profession::query();

        if (!empty($this->selectedSkills)) {
            // Filtrar por habilidades seleccionadas
            $query->whereHas('skills', function ($q) {
                $q->whereIn('name', $this->selectedSkills);
            });
        }
        

        $professions = $query
            ->applyFilters([
                'nameFilter' => $this->nameFilter,
            ])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $skills = Skill::pluck('name');

        return view('livewire.admin.show-professions', compact('professions', 'skills'))
            ->layout('layouts.admin');
    }
}
