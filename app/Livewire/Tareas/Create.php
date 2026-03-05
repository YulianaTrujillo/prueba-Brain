<?php

namespace App\Livewire\Tareas;

use App\Models\Proyecto;
use App\Models\Tarea;
use Livewire\Component;

class Create extends Component
{
    public Proyecto $proyecto;

    public string $titulo = '';
    public ?string $descripcion = null;
    public string $estado = 'pendiente';

    public function mount(Proyecto $proyecto): void
    {
        $this->proyecto = $proyecto;
        abort_unless($proyecto->user_id === auth()->id(), 403);
    }

     protected function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'min:3', 'max:150'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'estado' => ['required', 'in:' . implode(',', Tarea::estados())],
        ];
    }

    public function save(): void
    {
        $data = $this->validate();

        $this->proyecto->tareas()->create($data);

        session()->flash('success', 'Tarea creada correctamente.');
        $this->redirectRoute('tareas.index', $this->proyecto, navigate: true);
    }    

    public function render()
    {
        return view('livewire.tareas.create');
    }
}
