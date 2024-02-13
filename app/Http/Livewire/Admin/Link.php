<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Size;
use App\Models\ColorSize;
use Livewire\Component;
use Livewire\WithPagination;

class Link extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 10;
    public $name = true;
    public $c = true;
    public $s = true;

    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $nameFilter;
    public $categoryFilter;
    public $maxCreatedFilter;
    public $minCreatedFilter;
    public $colorsFilter;
    public $sizeFilter;

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category'){
                $this->sortField = 'subcategory_id' ;
            } elseif($field === 'brand'){
                $this->sortField = 'brand_id' ;
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
        if($this->maxCreatedFilter){
            $query->whereDate('created_at', '<=', "%{$this->maxCreatedFilter}%");

        }
        if($this->minCreatedFilter){
            $query->whereDate('created_at', '>=', "%{$this->minCreatedFilter}%");

        }

        if ($this->colorsFilter) {
            $query->whereHas('colors');
        }
        
        

        if($this->sizeFilter){
            $query->whereHas('sizes');

        }

        $products = $query
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate($this->perPage);
        $colors = Color::all();
        $colorSize = ColorSize::all();
        $colorProduct = ColorProduct::all();
        $sizes = Size::all();


        return view('livewire.admin.link', [
            'products' => $products,
            'colors' => $colors,
            'colorSize' => $colorSize,
            'colorProduct' => $colorProduct,
            'sizes' => $sizes,
            'name' => $this->name,
            'color' => $this->c,
            'quantity' => $this->s,
            'nameFilter' => $this->nameFilter,
            'categoryFilter' => $this->categoryFilter,
            'maxCreatedFilter' => $this->maxCreatedFilter,
            'minCreatedFilter' => $this->minCreatedFilter,
            'colorsFilter' => $this->colorsFilter,
            'sizeFilter' => $this->sizeFilter,
        ])
            ->layout('layouts.admin');
    }

    public function resetFilters(){
        $this->nameFilter = null;
             $this->categoryFilter = null ;
             $this->maxCreatedFilter = null ; 
            $this->minCreatedFilter = null;
            $this->colorsFilter = null;
            $this->sizeFilter = null;
    }
}