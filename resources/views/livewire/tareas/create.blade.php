<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <div class="min-w-0">
                <h1 class="text-xl font-semibold text-gray-900 break-words">
                    {{ $proyecto->nombre }}
                </h1>
                <h2 class="text-l font-semibold text-gray-900 break-words">
                    Agregar tarea
                </h2>               
            </div>   
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white border border-gray-200 shadow-sm rounded-lg px-8 py-6">
                <form wire:submit.prevent="save" class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" wire:model.defer="titulo"
                               class="mt-1 block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('titulo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estado</label>
                        <select wire:model.defer="estado"
                                class="mt-1 block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="pendiente">Pendiente</option>
                            <option value="en_progreso">En progreso</option>
                            <option value="hecha">Hecha</option>
                        </select>
                        @error('estado') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción (opcional)</label>
                        <textarea rows="4" wire:model.defer="descripcion"
                                  class="mt-1 block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        @error('descripcion') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('tareas.index', $proyecto) }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 transition">
                            Guardar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>