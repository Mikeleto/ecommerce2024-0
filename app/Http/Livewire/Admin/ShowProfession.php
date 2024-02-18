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

    public $sortBy = 'title'; 
    public $sortDirection = 'asc'; 

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
        $professions = Profession::where('title', 'LIKE', "%{$this->search}%")
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.admin.show-professions', compact('professions'))
            ->layout('layouts.admin');
    }
}
