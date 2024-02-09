<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ColorProduct;
use App\Models\Color;
use App\Models\ColorSize;
use App\Models\Size;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Productos2 extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 10; 
    public $name = true;
    public $category = true;
    public $status = true;
    public $price = true;
    public $subcategory = true;
    public $brand = true;
    public $created_at = true;
    public $colors = true;
    public $stockColor = true; 
    public $sizes = true;
    public $stockSizes = true;
    public $stock = true;

    public $sortField = 'name';
    public $sortBrandField = 'name';
    public $sortDirection = 'asc';

    public $nameFilter;
    public $categoryFilter;
    public $brandFilter;
    public $maxPriceFilter;
    public $minPriceFilter;
    public $maxCreatedFilter;
    public $minCreatedFilter;

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

    public function sortSubcategory($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            
        }else{
            if($field === 'name'){
                $this->sortField = 'name' ;
            } 
        }
    }

    public function sortBrand($field){
        if($this->sortBrandField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }
    }

    public function sortColor($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }
    }

    public function sortSize($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }
    }

    
    public function filterColors()
    {
        $this->resetPage(); // Reiniciar la paginación
    
        // Realizar la consulta de productos con el filtro de colores
        $products = Product::where('name', 'LIKE', "%{$this->search}%")
            ->whereHas('colors', function ($query) {
                // Aquí puedes agregar lógica específica para filtrar por colores
                // Por ejemplo, podrías usar una condición como $query->where('color', '=', 'rojo');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    
        // Actualizar la variable de productos en el estado del componente
        $this->products = $products;
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
            $query->whereHas('subcategory.category', function($q){
                $q->where('name', 'LIKE', "%{$this->categoryFilter}%");
            });
           
        }
        if($this->brandFilter){
            $query->whereHas('brand', function($q){
                $q->where('name', 'LIKE', "%{$this->brandFilter}%");
            });
           
        }
        if($this->maxPriceFilter){
            $query->where('price', '<=', "$this->maxPriceFilter");
        }
        if($this->minPriceFilter){
            $query->where('price', '>=', "$this->minPriceFilter");
        }
        if($this->maxCreatedFilter){
            $query->where('created_at', '<=', "$this->maxCreatedFilter");
        }
        if($this->minCreatedFilter){
            $query->where('created_at', '>=', "$this->minCreatedFilter");
        }
        $products = $query
        ->orderBy($this->sortField, $this->sortDirection)
        
    ->paginate($this->perPage);

    $subcategories = Subcategory::where('name', 'LIKE', "%{$this->search}%")
    ->orderBy($this->sortField, $this->sortDirection);

    $brands = Brand::where('name', 'LIKE', "%{$this->search}%")
        ->orderBy($this->sortBrandField, $this->sortDirection);

        
    
    
        $colorProduct = ColorProduct::all();
        $color = Color::all();
        $colorSize = ColorSize::all();
        $size = Size::all();
    
        return view('livewire.admin.productos2', [
            'products' => $products,
            'subcategories' => Subcategory::where('name', 'LIKE', "%{$this->search}%")->orderBy($this->sortField, $this->sortDirection)->get(),
            'brands' => Brand::where('name', 'LIKE', "%{$this->search}%")->orderBy($this->sortBrandField, $this->sortDirection)->get(),
            'colorProduct' => ColorProduct::all(),
            'color' => Color::all(),
            'colorSize' => ColorSize::all(),
            'size' => Size::all(),
            'search' => $this->search,
            'name' => $this->name,
            'category' => $this->category,
            'status' => $this->status,
            'price' => $this->price,
            'subcategory' => $this->subcategory,
            'brand' => $this->brand,
            'created_at' => $this->created_at,
            'colors' => $this->colors,
            'stockColor' => $this->stockColor,
            'sizes' => $this->sizes,
            'stockSizes' => $this->stockSizes,
            'stock' => $this->stock,
            'nameFilter' => $this->nameFilter,
            'categoryFilter' => $this->categoryFilter,
            'brandFilter' => $this->brandFilter,
            'maxPriceFilter' => $this->maxPriceFilter,
            'minPriceFilter' => $this->minPriceFilter,
            'maxCreatedFilter' => $this->maxCreatedFilter,
            'minCreatedFilter' => $this->minCreatedFilter,
        ])->layout('layouts.admin');

      
    }
    public function resetFilters(){
        $this->nameFilter = null;
        $this->categoryFilter = null;
        $this->brandFilter = null;
        $this->maxPriceFilter = null;
        $this->minPriceFilter = null;
        $this->maxCreatedFilter = null;
        $this->minCreatedFilter = null;
    }
}