<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-900">Mis Proyectos</h2>

            <a href="{{ route('proyectos.create') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 transition">
                Crear Proyecto
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">

           @if (session()->has('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 2200)"
                    x-show="show"
                    x-transition.opacity.duration.300ms
                    class="mb-4 flex items-center justify-between p-3 bg-green-50 border border-green-200 text-green-800 rounded"
                >
                    <span>{{ session('success') }}</span>

                    <button type="button"
                            class="ml-4 text-green-800/70 hover:text-green-900"
                            @click="show = false">
                        ✕
                    </button>
                </div>

                @php(session()->forget('success'))
            @endif

            @forelse($proyectos as $proyecto)
                <div class="bg-white border border-gray-200 shadow-sm px-8 py-5 mb-4 rounded-lg">
                    <div class="flex justify-between items-center gap-4">
                        <div class="min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 break-words">{{ $proyecto->nombre }}</h3>
                            <p class="text-gray-600 mt-1 break-words">{{ $proyecto->descripcion }}</p>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('proyectos.edit', $proyecto) }}"
                               class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-white bg-gray-800 rounded hover:bg-gray-700 transition">
                                Editar
                            </a>

                            <button type="button"
                                    onclick="if(confirm('¿Estás seguro de que quieres eliminar este proyecto?')) { @this.delete({{ $proyecto->id }}) }"
                                    class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-500 transition">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p>No tienes proyectos aún.</p>
            @endforelse

        </div>
    </div>
</div>