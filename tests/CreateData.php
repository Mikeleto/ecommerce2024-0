<?php

namespace App;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\Department;
use App\Models\District;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

trait CreateData
{
    use WithFaker;

    public function createBrand($name)
    {
        return Brand::create(['name' => $name]);
    }

    public function createCategory($name, $slug, $image = null, $icon = null)
    {
        return Category::create([
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'icon' => $icon,
        ]);
    }

    public function createColor($name)
    {
        return Color::create(['name' => $name]);
    }

    public function createColorProduct($productId, $colorId, $quantity)
    {
        return ColorProduct::create([
            'product_id' => $productId,
            'color_id' => $colorId,
            'quantity' => $quantity,
        ]);
    }

    public function createColorSize($colorId, $sizeId)
    {
        return ColorSize::create(['color_id' => $colorId, 'size_id' => $sizeId]);
    }

    public function createProduct($name, $brandId, $categoryId, $quantity = 0)
    {
        return Product::create([
            'name' => $name,
            'brand_id' => $brandId,
            'category_id' => $categoryId,
            'quantity' => $quantity,
        ]);
    }

    public function createSize($name, $productId)
    {
        return Size::create(['name' => $name, 'product_id' => $productId]);
    }

    public function createSubcategory($name, $slug, $categoryId)
    {
        return Subcategory::create(['name' => $name, 'slug' => $slug, 'category_id' => $categoryId]);
    }

    public function createOrder($productId, $quantity)
    {
        return Order::create(['product_id' => $productId, 'quantity' => $quantity]);
    }

}