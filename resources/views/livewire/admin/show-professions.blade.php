<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de profesiones
            </h2>

        </div>
    </x-slot>

    <x-table-responsive>
        

        @if($professions->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a wire:click="sortBy('title')" href="#">
                        Nombre
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nivel de educación
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Salario
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Experiencia requerida
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($professions as $profession)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                                <div class="ml-4">
                                <div class="text-sm text-gray-900">{{ $profession->title }}</div>
                            <div class="text-sm text-gray-500">{{ $profession->sector }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $profession->education_level }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $profession->salary }} &euro;
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $profession->experience_required }}
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

        <div class="px-6 py-4">
            <label for="perPage">Productos por página:</label>
            <select wire:model="perPage" id="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

        @if($professions->hasPages())
            <div class="px-6 py-4">
                {{ $professions->links() }}
            </div>
        @endif

        
        

       
    </x-table-responsive>
</div>