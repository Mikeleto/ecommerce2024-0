<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\BrandComponent;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\DepartmentComponent;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\ShowCity;
use App\Http\Livewire\Admin\ShowDepartment;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\Productos2;
use App\Http\Livewire\Admin\Zelda;
use App\Http\Livewire\Admin\Link;
use App\Http\Livewire\Admin\Trash;
use App\Http\Livewire\Admin\ShowProfession;
use App\Http\Livewire\Admin\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');
Route::get('professions', ShowProfession::class)->name('admin.professions.index');
Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');
Route::post('product/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');
Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');
Route::get('brands', BrandComponent::class)->name('admin.brands.index');
Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
Route::get('departments', DepartmentComponent::class)->name('admin.departments.index');
Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');
Route::get('cities/{city}', ShowCity::class)->name('admin.cities.show');
Route::get('users', UserComponent::class)->name('admin.users.index');

Route::get('productos2', Productos2::class)->name('admin.productos2.index');
Route::get('zelda', Zelda::class)->name('admin.zelda.index');
Route::get('link', Link::class)->name('admin.link.index');
Route::get('trash', Trash::class)->name('admin.trash.index');
