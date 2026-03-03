<?php

namespace App\Livewire\Proyectos;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Proyecto;
use Livewire\Component;


class Index extends Component
{
    use AuthorizesRequests;

    public function delete(int $id): void
    {
        $proyecto = Proyecto::findOrFail($id);
        $this->authorize('delete', $proyecto);
        $proyecto->delete();
        session()->flash('success', 'Proyecto eliminado.');
    }

    public function render()
    {
        $this->authorize('viewAny', Proyecto::class);

        $proyectos = auth()->user()->proyectos()->latest()->get();
        return view('livewire.proyectos.index',compact('proyectos'));
    }
}
