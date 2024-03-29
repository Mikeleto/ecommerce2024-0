<?php

namespace App\Models;

use App\Filters\ProductFilter;
use App\Queries\ProductBuilder;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $fillable = ['name', 'slug', 'description', 'price', 'subcategory_id', 'brand_id', 'quantity'];
    //protected $guarded = ['id', 'created_at', 'updated_at'];

    public function newEloquentBuilder($query)
    {
        return new ProductBuilder($query);
    }

    public function newQueryFilter()
    {
        return new ProductFilter();
    }

    public function sizes(){
        return $this->hasMany(Size::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function orders()
{
    return $this->belongsToMany(Order::class)->withPivot('quantity');
}

public function colorProducts()
{
    return $this->hasMany(ColorProduct::class);
}
}
