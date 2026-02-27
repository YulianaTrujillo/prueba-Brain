<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Mis Proyectos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('proyectos.create') }}"
                   class="bg-blue-500 text-grey px-4 py-2 rounded">
                    Crear Proyecto
                </a>
            </div>

            @forelse($proyectos as $proyecto)
                <div class="bg-white shadow p-4 mb-3 rounded">
                    <h3 class="text-lg font-bold">
                        {{ $proyecto->nombre }}
                    </h3>
                    <p>{{ $proyecto->descripcion }}</p>
                </div>
            @empty
                <p>No tienes proyectos aún.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>