<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $open = false;
    public $categoryFilter;

    public function updatedSearch($value)
    {
        $value ? $this->open = true : $this->open = false;
    }

    public function render()
    {
        $categories = Category::all();
        $query = Product::query()->where('status', 2);

        if ($this->search) {
            $query->where(function ($query) {
                $query->where('name', 'LIKE', "%{$this->search}%");
            });
        }

        if ($this->categoryFilter) {
            $query->whereHas('subcategory.category', function ($q) {
                $q->where('name', 'LIKE', "%{$this->categoryFilter}%");
            });
        }

        $products = $query->take(8)->get();

        return view('livewire.search', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
