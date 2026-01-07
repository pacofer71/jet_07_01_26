<x-app-layout>
    <x-mios.base>
        <div class="mb-1">
            {{ $posts->links() }}
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach ($posts as $item)
                <article
                    @class([
                        "transform hover:scale-95 transition-transform duration-300 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300",
                        "col-span-1 md:col-span-2"=>$loop->first
                        ])>

                    <!-- Imagen -->
                    <img src="{{ Storage::url($item->imagen) }}" alt="Imagen del post" class="w-full h-48 object-cover" />

                    <div class="p-5 space-y-3">

                        <!-- Categoría con color propio -->
                        <span class="text-white inline-block px-3 py-1 text-sm font-medium rounded-full"
                            style="background-color:{{ $item->category->color }}">
                            {{ $item->category->nombre }}
                        </span>

                        <!-- Título -->
                        <h2 class="text-xl font-semibold text-gray-900 leading-tight">
                            {{ $item->titulo }}
                        </h2>

                        <!-- Contenido -->
                        <p class="text-gray-600 text-sm">
                            {{ $item->contenido }}
                        </p>

                        <!-- Email del creador -->
                        <div class="pt-2 border-t border-gray-200">
                            <p class="text-xs text-gray-500">
                                Creado por: {{ $item->user->email }}
                            </p>
                        </div>

                    </div>
                </article>
            @endforeach
        </div>
    </x-mios.base>
</x-app-layout>
