<x-mios.base>
    <div class="mb-2 flex items-center justify-between">
        <div>
            <input type="search" placeholder="Buscar..." class="rounded-lg" wire:model.live="buscar" />
        </div>
        @livewire('crear-post')
    </div>
    @if ($posts->count())
    <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
        <table class="min-w-full text-sm text-gray-700">

            <!-- Cabecera -->
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">Imagen</th>
                    <th class="px-6 py-4 text-left cursor-pointer" wire:click="ordenar('titulo')">
                        <i class="fas fa-sort mr-1"></i>Título
                    </th>
                    <th class="px-6 py-4 text-left cursor-pointer" wire:click="ordenar('contenido')">
                        <i class="fas fa-sort mr-1"></i>Contenido
                    </th>
                    <th class="px-6 py-4 text-left cursor-pointer" wire:click="ordenar('estado')">
                        <i class="fas fa-sort mr-1"></i>Estado
                    </th>
                    <th class="px-6 py-4 text-left cursor-pointer" wire:click="ordenar('category')">
                        <i class="fas fa-sort mr-1"></i>Categoría
                    </th>
                    <th class="px-6 py-4 text-center">Acciones</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="divide-y divide-gray-200">

                <!-- Fila de ejemplo -->
                @foreach ($posts as $item)
                <tr class="hover:bg-gray-50 transition">
                    <!-- Imagen -->
                    <td class="px-6 py-4">
                        <img src="{{ Storage::url($item->imagen) }}" alt="Post image" class="w-14 h-14 rounded-lg object-cover" />
                    </td>

                    <!-- Título -->
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $item->titulo }}
                    </td>

                    <!-- Contenido -->
                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->contenido }}
                    </td>

                    <!-- Estado -->
                    <td class="px-6 py-4">
                        <button @class([ 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white' , 'bg-red-600'=> $item->estado == 'Borrador',
                            'bg-green-600' => $item->estado == 'Publicado',
                            ]) wire:click="cambiarEstado({{$item->id}})">
                            {{ $item->estado }}
                        </button>
                    </td>

                    <!-- Categoría -->
                    <td class="px-6 py-4">
                        <p class="text-center text-sm text-white px-3 py-1 rounded-lg" style="background-color: {{ $item->category->color }}">
                            {{ $item->category->nombre }}
                        </p>
                    </td>

                    <!-- Acciones -->
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-3">
                            <button class="text-blue-600 hover:text-blue-800 transition" wire:click="editarPost({{$item->id}})">
                                ✏️
                            </button>
                            <button class="text-red-600 hover:text-red-800 transition" wire:click="pedirBorrar({{$item->id}})">
                                🗑️
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>
    @else
    <x-mios.alerta>
        No se encontró ningún Post, aproveche para crear alguno.
    </x-mios.alerta>
    @endif
    <!-- -------------------------------------------Modal para actualizar el post-------------------------------------------- -->
    @isset($uform->post)
    <x-dialog-modal wire:model="openUpdate" maxWidth="4xl">
        <x-slot name="title">
            Editar Post
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
                    <input type="text" placeholder="Escribe el título..." wire:model="uform.titulo" class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 text-gray-800
             focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>
                <x-input-error for="uform.titulo" />
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
                    <textarea rows="4" placeholder="Escribe el contenido..." wire:model="uform.contenido" class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 text-gray-800
             focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none resize-none"></textarea>
                </div>
                <x-input-error for="uform.contenido" />
            </div>

            <!-- Estado -->
            <div class="mt-5 space-y-3">
                <label class="block text-sm font-medium text-gray-700">
                    Estado
                </label>

                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer text-gray-700">
                        <input type="radio" name="estado" wire:model="uform.estado" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" value="Publicado" />
                        <i class="fa-solid fa-eye text-green-500"></i>
                        Publicado
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer text-gray-700">
                        <input type="radio" name="estado" value="Borrador" wire:model="uform.estado" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" />
                        <i class="fa-solid fa-file-lines text-yellow-500"></i>
                        Borrador
                    </label>
                </div>
                <x-input-error for="uform.estado" />
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
                    <select wire:model="uform.category_id" class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 text-gray-800
             focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option>Elija una categoria.</option>
                        @foreach($categorias as $item)
                        <option value="{{ $item->id }}">{{$item->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="uform.category_id" />
            </div>
            <!-- Imagen -->
            <div class="mt-5 space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Imagen
                </label>
            </div>
            <div class="relative w-full h-80 bg-gray-200">
                <input type="file" class="hidden" accept="image/*" id="uimagen" wire:model="uform.imagen" />
                <label for="uimagen" class="absolute bottom-2 right-2 bg-green-600 hover:bg-green-800 text-white font-bold p-2 rounded-lg" wire:loading.remove wire:target="uform.imagen">
                    <i class="fas fa-upload mr-2"></i>Elegir Imagen
                </label>
                @if($uform->imagen)
                <img src="{{ $uform->imagen->temporaryUrl() }}" class="w-full h-full object-center object-contain bg-no-repeat" />
                @else
                <img src="{{ Storage::url($uform->post->imagen) }}" class="w-full h-full object-center object-contain bg-no-repeat" />
                @endif

            </div>
            <x-input-error for="uform.imagen" />

        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse gap-2">
                <button class="p-2 text-white rounded-lg bg-blue-500 hover:bg-blue-700 font-bold" wire:click="update" wire:loading.attr="disabled">
                    <i class="fas fa-save mr-2"></i>GUARDAR
                </button>
                <button class="p-2 text-white rounded-lg bg-red-500 hover:bg-red-700 font-bold" wire:click="cancelar">
                    <i class="fas fa-xmark mr-2"></i>CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endisset

</x-mios.base>
