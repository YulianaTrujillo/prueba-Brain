<?php

namespace App\Livewire\Proyectos;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Proyecto;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Proyecto $proyecto;

    public string $nombre = '';
    public ?string $descripcion = null;

    public function mount(Proyecto $proyecto): void
    {
        $this->authorize('update', $proyecto);
        $this->proyecto = $proyecto;
        $this->nombre = $proyecto->nombre;
        $this->descripcion = $proyecto->descripcion;
    }

    protected function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:120'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function update()
    {
        $this->authorize('update', $this->proyecto);
        $data = $this->validate();
        $this->proyecto->update($data);
        session()->flash('success', 'Proyecto actualizado correctamente.');
       
        return redirect()->route('proyectos.index');
    }

    public function render()
    {
        return view('livewire.proyectos.edit');
    }
}
