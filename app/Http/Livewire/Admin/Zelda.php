<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Zelda extends Component
{
    use WithPagination;

    public $search;

    public $perPage = 10;

    public $name = true;
    public $category = true;
    public $price = true;
    public $created_at = true;
    public $subcategory = true;
    public $status = true;
    public $brand = true;
    public $sold = true;
    public $stock = true;
    public $colors = true;

    public $nameFilter;
    public $categoryFilter;
    public $maxPriceFilter;
    public $minPriceFilter;

    public $sortField = 'name';
    public $sortDirection = 'asc';

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category'){
                $this->sortField = 'subcategory_id' ;
            } elseif($field === 'brands'){
                $this->sortField = 'name' ;
            }else{
                $this->sortField = $field;
            }
        }
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query();
        if($this->nameFilter){
        $query->where('name', 'LIKE', "%{$this->nameFilter}%");
        }

        if($this->categoryFilter){
        $query->whereHas('subcategory.category', function($p){
            $p->where('name', 'LIKE', "%{$this->categoryFilter}%");
        });
        }

     if($this->maxPriceFilter){
        $query->where('price', '<=', "$this->maxPriceFilter");
        }

     if($this->minPriceFilter){
        $query->where('price', '>=', "$this->minPriceFilter");
        }
        $products = $query
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate($this->perPage);
        $color = Color::all();
        $order = Product::all();
        return view('livewire.admin.zelda', [
            'products' => $products,
            'color' => $color,
            'order' => $order,
            'name' => $this->name,
            'category' => $this->category,
            'status' => $this->status,
            'price' => $this->price,
            'brand' => $this->brand,
            'sold' => $this->sold,
            'stock' => $this->stock,
            'colors' => $this->colors,
            'nameFilter' => $this->nameFilter,
            'categoryFilter' => $this->categoryFilter,
            'maxPriceFilter' => $this->maxPriceFilter,
            'minPriceFilter' => $this->minPriceFilter,

                     ])
                     
            ->layout('layouts.admin');
    }

    public function resetFilters(){
        $this->nameFilter = null;
            $this->categoryFilter = null;
            $this->maxPriceFilter = null;
             $this->minPriceFilter = null;
    }
}
