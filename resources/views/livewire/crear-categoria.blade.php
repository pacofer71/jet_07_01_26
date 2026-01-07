<div>
    <button class="p-2 text-white rounded-lg bg-blue-500 hover:bg-blue-700 font-bold"
        wire:click="$set('mostrarCrear', true)">
        <i class="fas fa-add mr-2"></i>NUEVA
    </button>
    <x-dialog-modal wire:model="mostrarCrear">
        <x-slot name="title">
            Crear Categoria
        </x-slot>
        <x-slot name="content">
            <!-- Campo: Nombre -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Nombre</label>
                <div
                    class="flex items-center gap-3 bg-white border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                    <i class="fa-solid fa-tag text-gray-500"></i>
                    <input type="text" placeholder="Nombre de la categoría" wire:model="cform.nombre"
                        class="w-full focus:outline-none text-gray-800">

                </div>
                <x-input-error for="cform.nombre" />
            </div>

            <!-- Campo: Color -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Color</label>
                <div
                    class="flex items-center gap-3 bg-white border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">
                    <i class="fa-solid fa-palette text-gray-500"></i>
                    <input type="color" class="h-10 p-0 border-0 rounded cursor-pointer focus:outline-none w-full"
                        wire:model="cform.color">

                </div>
                <x-input-error for="cform.color" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse gap-2">
                <button class="p-2 text-white rounded-lg bg-blue-500 hover:bg-blue-700 font-bold" wire:click="guardar">
                    <i class="fas fa-save mr-2"></i>GUARDAR
                </button>
                <button class="p-2 text-white rounded-lg bg-red-500 hover:bg-red-700 font-bold" wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
