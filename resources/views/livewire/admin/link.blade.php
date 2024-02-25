    <div>
        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    Link
                </h2>

                <x-button-link dusk="agregarProducto" class="ml-auto" href="{{route('admin.products.create')}}">
                    Agregar producto
                </x-button-link>
            </div>
        </x-slot>
        <div class="px-6 py-4">
        <x-jet-input class="w-100"
                            dusk="nameFilter"
                            wire:model="nameFilter"
                            type="text"
                            placeholder="Filtrar por nombre" />
              
        
                <x-jet-input type="date" class=" w-100" placeholder="Fecha minima" wire:model.lazy="minCreatedFilter"/>
                <x-jet-input type="date" class=" w-100" placeholder="Fecha máxima" wire:model.lazy="maxCreatedFilter"/>
                <div>
    <label for="categorySelect">Seleccionar Categoría:</label>
    <select wire:model="selectedCategory" id="categorySelect">
        <option value="">Todas las Categorías</option>
        @foreach($this->getAllCategories() as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div>
    <label for="brandSelect">Seleccionar Marca:</label>
    <select wire:model="selectedBrand" id="brandSelect">
        <option value="">Todas las Marcas</option>
        @foreach($this->getAllBrands() as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
        @endforeach
    </select>
</div>

                <div>
    <label for="colorSelect">Seleccionar Color:</label>
    <select wire:model="selectedColor" id="colorSelect">
        <option value="">Todos los colores</option>
        @foreach($colors as $color)
            <option value="{{ $color->id }}">{{ $color->name }}</option>
        @endforeach
    </select>
</div>
            <div class="mt-1">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="colorsFilter" class="form-checkbox text-indigo-600">
                    <span class="ml-2">Productos con colores</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="sizeFilter" class="form-checkbox text-indigo-600">
                    <span class="ml-2">Productos con tallas</span>
                </label>
            </div>
                <x-button-link class="ml-auto" wire:click="resetFilters">
                    Resetear filtros
                </x-button-link>

            </div>
        <x-table-responsive>
        <div class="flex inline-flex border-gray-300 border mx-6 p-8">
                <x-jet-dropdown>
                    <x-slot name="trigger">
                        <button dusk="columnas">Columnas a mostrar</button>
                    </x-slot>

                    <x-slot name="content">
                        <div>
                            Nombre<input dusk="nombreCheck" type="checkbox" wire:model="name">
                        </div>
                        <div>
                            Color<input type="checkbox" wire:model="c">
                        </div>
                        <div>
                            Stock color<input type="checkbox" wire:model="s">
                        </div>
                    
                    </x-slot>
                </x-jet-dropdown>
                
            </div>
            <div class="px-6 py-4">
                <x-jet-input class="w-full"
                            wire:model="search"
                            type="text"
                            placeholder="Introduzca el nombre del producto a buscar" dusk="buscador"/>
            </div>

            @if($products->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        
                        @if($name)
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="#" wire:click="sortBy('name')">Nombre</a>
                        </th>
                        @endif
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoría
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="#" wire:click="sortBy('price')">Precio</a>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Marca
                        </th>
                        @if($c)
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Color
                        </th>
                        @endif
                        @if($s)
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stock color
                        </th>
                        @endif
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="#" wire:click="sortBy('name')">Tallas</a>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stock tallas
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="#" wire:click="sortBy('quantity')">Stock productos</a>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha de creacion
                        </th>

                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Editar</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr>
                            @if($name)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 object-cover">
                                        <img class="h-10 w-10 rounded-full"
                                            src="{{ $product->images->count() ? Storage::url($product->images->first()->url) : 'img/default.jpg'  }}"
                                            alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $product->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}</div>
                                <div class="text-sm text-gray-500">{{ $product->subcategory->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $product->status == 1 ? 'red' : 'green'
                                }}-100 text-{{ $product->status == 1 ? 'red' : 'green' }}-800">
                                    {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->price }} &euro;
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->brand->name }}
                            </td>
                            @if($c)
                            <td>
                                            @if($product->colors)
                                                @foreach($product->colors as $color)
                                                <div class="text-sm text-gray-900">{{ $color->name }}</div>
                                            @endforeach
                                            @endif
                                            @if($product->sizes)
                                                @foreach($product->colors as $color)
                                                <div class="text-sm text-gray-900">{{ $color->name }}</div>
                                            @endforeach
                                            @endif
                                            </td>
        @endif
        @if($product->colors->isNotEmpty())
        @if($s)
            <td>
                @foreach($colorProduct as $color)
                <div class="text-sm text-gray-900"> {{ $color->quantity }}</div>
                @endforeach
            </td>
        @endif
        @endif
        @if($product->sizes)
            <td>
                @foreach($product->sizes as $size)
                    {{ $size->name }}
                @endforeach
            </td>
            <td>
                @foreach($product->sizes as $size)
                    {{ $size->name }} {{-- Se asume que la relación es de muchos a muchos con un campo quantity en la tabla pivote --}}
                @endforeach
            </td>
        @else
            <td>
                <div class="text-sm text-gray-900">Sin tallas</div>
            </td>
            <td>
                <div class="text-sm text-gray-900"></div>
            </td>
        @endif
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->quantity }}
                            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->created_at }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No existen productos coincidentes
                </div>
            @endif

            @if($products->hasPages())
                <div class="px-6 py-4">
                    {{ $products->links() }}
                </div>
            @endif
          
            <div>
        <label for="perPage">Elementos por página:</label>
        <select wire:model="perPage" id="perPage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>
        </x-table-responsive>
    </div>