<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <div class="min-w-0">
                <h1 class="text-xl font-semibold text-gray-900 break-words">
                    {{ $proyecto->nombre }}
                </h1>
                <h2 class="text-l font-semibold text-gray-900 break-words">
                    Tareas
                </h2>               
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('tareas.create', $proyecto) }}"
                    class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white bg-emerald-600 rounded hover:bg-emerald-700 transition">
                    Agregar tarea
                </a>

                <a href="{{ route('proyectos.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 transition">
                    ← Volver
                </a>
            </div>   
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session()->has('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 2200)"
                    x-show="show"
                    x-transition.opacity.duration.300ms
                    class="mb-4 flex items-center justify-between p-3 bg-green-50 border border-green-200 text-green-800 rounded"
                >
                    <span>{{ session('success') }}</span>
                    <button type="button" class="ml-4" @click="show = false">✕</button>
                </div>
                @php(session()->forget('success'))
            @endif        

            <div class="bg-white border border-gray-200 shadow-sm px-8 py-4 mb-4 rounded-lg flex flex-wrap items-center justify-between gap-3">
                <div class="text-sm text-gray-700 font-medium">Filtrar por estado:</div>

                <div class="flex items-center gap-2">
                    <button wire:click="$set('filtroEstado','all')"
                            class="px-3 py-1 text-xs font-medium rounded {{ $filtroEstado==='all' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Todas
                    </button>

                    <button wire:click="$set('filtroEstado','pendiente')"
                            class="px-3 py-1 text-xs font-medium rounded {{ $filtroEstado==='pendiente' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Pendiente
                    </button>

                    <button wire:click="$set('filtroEstado','en_progreso')"
                            class="px-3 py-1 text-xs font-medium rounded {{ $filtroEstado==='en_progreso' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        En progreso
                    </button>

                    <button wire:click="$set('filtroEstado','hecha')"
                            class="px-3 py-1 text-xs font-medium rounded {{ $filtroEstado==='hecha' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Hecha
                    </button>
                </div>
            </div>

            <div class="space-y-3">
                @forelse($tareas as $tarea)
                    <div class="bg-white border border-gray-200 shadow-sm px-8 py-5 rounded-lg flex justify-between items-center gap-4">
                        <div class="min-w-0">
                            <h3 class="text-base font-semibold text-gray-900 break-words">
                                {{ $tarea->titulo }}
                            </h3>

                            @if($tarea->descripcion)
                                <p class="text-sm text-gray-600 mt-1 break-words">{{ $tarea->descripcion }}</p>
                            @endif
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            
                            <select
                                class="rounded border-gray-300 text-sm"
                                onchange="@this.setEstado({{ $tarea->id }}, this.value)"
                            >
                                <option value="pendiente" @selected($tarea->estado==='pendiente')>Pendiente</option>
                                <option value="en_progreso" @selected($tarea->estado==='en_progreso')>En progreso</option>
                                <option value="hecha" @selected($tarea->estado==='hecha')>Hecha</option>
                            </select>

                            <a href="{{ route('tareas.edit', [$proyecto, $tarea]) }}"
                                class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-white bg-gray-800 rounded hover:bg-gray-700 transition">
                                Editar
                            </a>

                            <button type="button"
                                    onclick="if(confirm('¿Estás seguro que quieres eliminar esta tarea?')) { @this.delete({{ $tarea->id }}) }"
                                    class="inline-flex items-center justify-center px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-500 transition">
                                Eliminar
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No hay tareas.</p>
                @endforelse
            </div>

        </div>
    </div>
</div>