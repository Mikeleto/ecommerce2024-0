<?php

namespace Tests;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\Department;
use App\Models\District;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\User;

trait CreateData
{

    public function createCategory(){
        return  Category::factory()->create([
            'name' => 'categoria',
            'slug' => 'categoria',
            'icon' => 'categoria',
        ]);

    }

    public function createSubcategory( $category , $color = false , $size = false){
        return Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => $color,
            'size' => $size,
        ]);
    }

    public function createSubcategoryWithColor( $category, $color = true){
        return Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => $color,
        ]);
    }

    public function createSubcategoryWithColorSize( $category, $color = true , $size = true){
        return Subcategory::factory()->create([
            'category_id' => $category->id,
            'name' => 'ropa',
            'slug' => 'ropa',
            'color' => $color,
            'size' => $size
        ]);
    }
    public function createBrand($category)
    {
        $brand = Brand::factory()->create();
        $category->brands()->attach($brand->id);
        return $brand;
    }
   
    public function createColor()
    {
        return Color::factory()->create();
    }

    public function createSize($product)
    {
        return Size::factory()->create([
            'product_id' => $product->id
        ]);
    }
    public function createProduct($subcategory, $brand)
    {
        $brand = $this->createBrand($subcategory->category);
        $category = $this->createCategory();
        $category->brands()->attach($brand->id);
        $subcategory = $this->createSubcategory($subcategory->category);
    
        $p1 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'quantity' => 2,
            'name' => 'algo1',
            'slug' => 'algo1',
        ]);
    
        Image::factory()->create([
            'imageable_id' => $p1->id,
            'imageable_type' => Product::class
        ]);
    
        return $p1;
    }
   
}