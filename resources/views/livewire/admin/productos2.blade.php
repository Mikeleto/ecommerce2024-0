<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de productos 2
            </h2>

            <x-button-link dusk="agregarProducto" class="ml-auto" href="{{route('admin.products.create')}}">
                Agregar producto
            </x-button-link>
        </div>
    </x-slot>

    <div class="px-6 py-4">
    <x-jet-input class="w-100"
                         wire:model="nameFilter"
                         type="text"
                         placeholder="Filtrar por nombre" />
            <x-jet-input class="w-100"
                         wire:model="categoryFilter"
                         type="text"
                         placeholder="Filtrar por categoria" />
            <x-jet-input class="w-100"
                         wire:model="brandFilter"
                         type="text"
                         placeholder="Filtrar por marca" />
            <x-jet-input type="number" class="w-100" placeholder="Precio minimo" wire:model.lazy="minPriceFilter" />
            <x-jet-input type="number" class=" w-100" placeholder="Precio máximo" wire:model.lazy="maxPriceFilter"/>
            <x-jet-input type="date" class=" w-100" placeholder="Fecha minima" wire:model.lazy="minCreatedFilter"/>
            <x-jet-input type="date" class=" w-100" placeholder="Fecha máxima" wire:model.lazy="maxCreatedFilter"/>
            <x-button-link class="ml-auto" wire:click="resetFilters">
                Resetear filtros
            </x-button-link>

        </div>
    <div>
            <x-jet-dropdown>
                <x-slot name="trigger">
                    <button>Filtros</button>
                </x-slot>
                <x-slot name="content">
                   
                   <button wire:click="filterColors">Filtrar por colores</button>
                
                </x-slot>
            </x-jet-dropdown>
            </div>
    <x-table-responsive>
    <div class="flex inline-flex border-gray-300 border mx-6 p-8">
            <x-jet-dropdown>
                <x-slot name="trigger">
                    <button>Columnas a mostrar</button>
                </x-slot>

                <x-slot name="content">
                    <div>
                        Nombre<input type="checkbox" wire:model="name">
                    </div>
                    <div>
                        Categoria<input type="checkbox" wire:model="category">
                    </div>
                    <div>
                        Estado<input type="checkbox" wire:model="status">
                    </div>
                    <div>
                        Precio<input type="checkbox" wire:model="price">
                    </div>
                    <div>
                        Marca<input type="checkbox" wire:model="brand">
                    </div>
                    <div>
                        Fecha<input type="checkbox" wire:model="created_at">
                    </div>
                    <div>
                        Color<input type="checkbox" wire:model="colors">
                    </div>
                    <div>
                        Stock Color<input type="checkbox" wire:model="stockColor">
                    </div>
                    <div>
                        Talla<input type="checkbox" wire:model="sizes">
                    </div>
                    <div>
                        Stock talla<input type="checkbox" wire:model="stockSizes">
                    </div>
                    <div>
                        Stock<input type="checkbox" wire:model="stock">
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
                        <a wire:click="sortBy('name')" href="#">
                    Nombre
                    </a>
                    </th>
                    @endif
                    @if($category)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('subcategory_id')" href="#">
                    Categoria
                    </a>
                    </th>
                    @endif
                    @if($status)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('status')" href="#">
                        Estado
                    </th>
                    @endif
                    @if($price)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('price')" href="#">
                    Precio
                    </a>
                    </th>
                    @endif
                    @if($subcategory)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortSubcategory('name')" href="#">
                    Subcategoria
                    </a>
                    </th>
                    @endif
                    @if($brand)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBrand('name')" href="#">
                    Marca
                    </a>
                    </th>
                    @endif
                    @if($created_at)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('created_at')" href="#">
                    Creado el
                    </a>
                    </th>
                    @endif
                    @if($colors)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('name')" href="#">
                    Color
                    </a>
                    </th>
                    @endif
                    @if($stockColor)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('quantity')" href="#">
                    Stock Color
                    </a>
                    </th>
                    @endif
                    @if($sizes)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('name')" href="#">
                    Talla
                    </a>
                    </th>
                    @endif
                    @if($stockSizes)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('quantity')" href="#">
                    Stock talla
                    </a>
                    </th>
                    @endif
                    @if($stock)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('quantity')" href="#">
                        Stock
                        </a>
                    </th>
                    @endif


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
                        @if($category)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->subcategory->name }}</div>
                        </td>
                        @endif
                        @if($status)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $product->status == 1 ? 'red' : 'green'
                            }}-100 text-{{ $product->status == 1 ? 'red' : 'green' }}-800">
                                {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                            </span>
                        </td>
                        @endif
                        @if($price)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->price }} &euro;
                        </td>
                        @endif
                        @if($subcategory)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->subcategory->name }}
                        </td>
                        @endif
                        @if($brand)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->brand->name }}
                        </td>
                        @endif
                        @if($created_at)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->created_at }}
                        </td>
                        @endif
                        @if($colors)
                        <td>
                                            @if($product->colors)
                                                @foreach($product->colors as $color)
                                                <div class="text-sm text-gray-900">{{ $color->name }}</div>
                                            @endforeach
                                            @endif
                                            </td>
                        @endif
                        @if($stockColor)
                        <td class="px-6 py-4 whitespace-nowrap">
                        @foreach($colorProduct as $colors)
                        <div class="text-sm text-gray-500">{{ $colors->quantity }}</div>
                        @endforeach
                        </td>
                        @else
                        @endif
                        @endif
                        @if($sizes)
                        @if($product->sizes->isNotEmpty())
                        <td class="px-6 py-4 whitespace-nowrap">
                        @foreach($size as $s)
                        <div class="text-sm text-gray-900">{{ $s->name }}</div>
                        @endforeach
                        </td>
                        @endif
                        @if($stockSizes)
                     
                        <td class="px-6 py-4 whitespace-nowrap">
                        @foreach($colorSize as $sizes)
                        {{ $sizes->quantity }}
                        @endforeach
                        </td>
                        @endif
                        @else
                        @endif
                      @if($stock)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->quantity }}
                        </td>
                        @endif
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