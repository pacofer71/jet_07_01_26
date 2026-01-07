<x-mios.base>
    <div class="flex w-full justify-between mb-2 items-center">
        <div>
            <input type="search" placeholder="Buscar..." class="rounded-lg" wire:model.live="cadena">
        </div>
        <div>
            @livewire('crear-categoria')
        </div>
    </div>
    @if ($categorias->count())
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 cursor-pointer" wire:click="ordenar('id')">
                            <i class="fas fa-sort mr-1"></i> ID
                        </th>
                        <th class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                            <i class="fas fa-sort mr-1"></i>Nombre
                        </th>
                        <th class="px-6 py-3 cursor-pointer" wire:click="ordenar('color')">
                            <i class="fas fa-sort mr-1"></i>Color
                        </th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Fila de ejemplo -->
                    @foreach ($categorias as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $item->id }}</td>
                            <td class="px-6 py-4">{{ $item->nombre }}</td>
                            <td class="px-6 py-4 flex items-center gap-2">
                                <!-- Círculo del color -->
                                <span class="w-4 h-4 rounded-full" style="background-color: {{ $item->color }}"></span>
                                <!-- Código hex -->
                                <span class="font-mono">{{ $item->color }}</span>
                            </td>

                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-800 font-medium" wire:click="edit({{ $item->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="ml-3 text-red-600 hover:text-red-800 font-medium"
                                    wire:click="mostrarConfirmacion({{ $item->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <x-mios.alerta>
            No se encontró nunguna categoría o aun no creo ninguna.
        </x-mios.alerta>
    @endif
    <!-- -----------------------------------------------------Ventana Modal para actualizar la Categoria -->
    <x-dialog-modal wire:model="mostrarUpdate">
        <x-slot name="title">
            Editar Categoria
        </x-slot>
        <x-slot name="content">
            <!-- Campo: Nombre -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Nombre</label>
                <div
                    class="flex items-center gap-3 bg-white border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                    <i class="fa-solid fa-tag text-gray-500"></i>
                    <input type="text" placeholder="Nombre de la categoría" wire:model="uform.nombre"
                        class="w-full focus:outline-none text-gray-800">

                </div>
                <x-input-error for="uform.nombre" />
            </div>

            <!-- Campo: Color -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Color</label>
                <div
                    class="flex items-center gap-3 bg-white border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                    <i class="fa-solid fa-palette text-gray-500"></i>
                    <input type="color" class="h-10 p-0 border-0 rounded cursor-pointer focus:outline-none w-full"
                        wire:model="uform.color">

                </div>
                <x-input-error for="uform.color" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse gap-2">
                <button class="p-2 text-white rounded-lg bg-blue-500 hover:bg-blue-700 font-bold" wire:click="update">
                    <i class="fas fa-save mr-2"></i>EDITAR
                </button>
                <button class="p-2 text-white rounded-lg bg-red-500 hover:bg-red-700 font-bold" wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    <!-- Fin de la Ventana -->
</x-mios.base>
