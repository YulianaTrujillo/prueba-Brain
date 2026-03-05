<?php

namespace App\Livewire\Tareas;

use App\Models\Proyecto;
use App\Models\Tarea;
use Livewire\Component;

class Index extends Component
{
    public Proyecto $proyecto;
    public string $filtroEstado = 'all';

    public function mount(Proyecto $proyecto): void
    {
        $this->proyecto = $proyecto;
        abort_unless($proyecto->user_id === auth()->id(), 403);
    }

    
    public function setEstado(int $tareaId, string $nuevoEstado): void
    {
        abort_unless(in_array($nuevoEstado, Tarea::estados(), true), 422);

        $tarea = Tarea::query()
            ->where('proyecto_id', $this->proyecto->id)
            ->findOrFail($tareaId);

        $tarea->update(['estado' => $nuevoEstado]);
        session()->flash('success', 'Estado actualizado.');
    }

    public function delete(int $tareaId): void
    {
        $tarea = Tarea::query()
            ->where('proyecto_id', $this->proyecto->id)
            ->findOrFail($tareaId);

        abort_unless($tarea->proyecto->user_id === auth()->id(), 403);
        $tarea->delete();
        session()->flash('success', 'Tarea eliminada.');
    }

    public function render()
    {
        $query = $this->proyecto->tareas()->latest(); 

        if ($this->filtroEstado !== 'all') {
            $query->where('estado', $this->filtroEstado);
        }

        $tareas = $query->get();

        return view('livewire.tareas.index', [
            'tareas' => $tareas,
        ]);
    }
}
