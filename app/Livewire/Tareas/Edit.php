<?php

namespace App\Livewire\Tareas;

use Livewire\Component;
use App\Models\Proyecto;
use App\Models\Tarea;

class Edit extends Component
{
    public Proyecto $proyecto;
    public Tarea $tarea;

    public string $titulo = '';
    public ?string $descripcion = null;

    public function mount(Proyecto $proyecto, Tarea $tarea): void
    {
        $this->proyecto = $proyecto;
        $this->tarea = $tarea;

        abort_unless($proyecto->user_id === auth()->id(), 403);
        abort_unless($tarea->proyecto_id === $proyecto->id, 404);
        abort_if($tarea->trashed(), 404);

        $this->titulo = $tarea->titulo;
        $this->descripcion = $tarea->descripcion;
    }

    protected function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'min:3', 'max:150'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function update(): void
    {
        $data = $this->validate();

        $this->tarea->update($data);

        session()->flash('success', 'Tarea actualizada correctamente.');
        $this->redirectRoute('tareas.index', $this->proyecto, navigate: true);
    }

    public function render()
    {
        return view('livewire.tareas.edit');
    }
}
