<div>
    <button class="p-2 rounded-xl text-white font-bold bg-blue-500 hover:bg-blue-700"
        wire:click="$set('openCrear', true)">
        <i class="fas fa-add mr-1"></i>NUEVO
    </button>
    <x-dialog-modal wire:model="openCrear" maxWidth="4xl">
        <x-slot name="title">
            Nuevo Post
        </x-slot>
        <x-slot name="content">
            <!-- Título -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Título
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-heading"></i>
                    </span>
                    <input type="text" placeholder="Escribe el título..." wire:model="cform.titulo"
                        class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 text-gray-800
             focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
                <x-input-error for="cform.titulo" />
            </div>

            <!-- Contenido -->
            <div class="space-y-2 mt-5">
                <label class="block text-sm font-medium text-gray-700">
                    Contenido
                </label>
                <div class="relative">
                    <span class="absolute top-3 left-3 text-gray-400">
                        <i class="fa-solid fa-align-left"></i>
                    </span>
                    <textarea rows="4" placeholder="Escribe el contenido..." wire:model="cform.contenido"
                        class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 text-gray-800
             focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none resize-none"></textarea>
                </div>
                <x-input-error for="cform.contenido" />
            </div>

            <!-- Estado -->
            <div class="mt-5 space-y-3">
                <label class="block text-sm font-medium text-gray-700">
                    Estado
                </label>

                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer text-gray-700">
                        <input type="radio" name="estado" wire:model="cform.estado" 
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" value="Publicado" />
                        <i class="fa-solid fa-eye text-green-500"></i>
                        Publicado
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer text-gray-700">
                        <input type="radio" name="estado" value="Borrador" wire:model="cform.estado" 
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" />
                        <i class="fa-solid fa-file-lines text-yellow-500"></i>
                        Borrador
                    </label>
                </div>
                <x-input-error for="cform.estado" />
            </div>

            <!-- Categoría -->
            <div class="mt-5 space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Categoría
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-tag"></i>
                    </span>
                    <select wire:model="cform.category_id"
                        class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 text-gray-800
             focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option>Elija una categoria.</option>
                        @foreach($categorias as $item)
                        <option value="{{ $item->id }}">{{$item->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="cform.category_id" />
            </div>
            <!-- Imagen -->
            <div class="mt-5 space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Imagen
                </label>
            </div>
            <div class="relative w-full h-80 bg-gray-200">
                <input type="file" class="hidden" accept="image/*" id="cimagen" wire:model="cform.imagen" />
                <label for="cimagen" class="absolute bottom-2 right-2 bg-green-600 hover:bg-green-800 text-white font-bold p-2 rounded-lg">
                    <i class="fas fa-upload mr-2"></i>Elegir Imagen
                </label>
                @if($cform->imagen)
                    <img src="{{ $cform->imagen->temporaryUrl() }}" class="w-full h-full object-center object-contain bg-no-repeat" />
                @endif

            </div>
            <x-input-error for="cform.imagen" />

        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse gap-2">
                <button class="p-2 text-white rounded-lg bg-blue-500 hover:bg-blue-700 font-bold" 
                    wire:click="guardar"
                    wire:loading.attr="disabled"
                >
                    <i class="fas fa-save mr-2"></i>GUARDAR
                </button>
                <button class="p-2 text-white rounded-lg bg-red-500 hover:bg-red-700 font-bold" wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
