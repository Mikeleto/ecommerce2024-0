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

    

  

    public function updatingSearch()
    {
        $this->resetPage();
    }

     

    public function render()
    {
        $products = Product::where('name', 'LIKE', "%{$this->search}%")
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
            'subcategories' => $subcategories,
            'brands' => $brands,
            'colorProduct' => $colorProduct,
            'color' => $color,
            'colorSize' => $colorSize,
            'size' => $size,
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
        ])->layout('layouts.admin');
    }
}