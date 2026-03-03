<?php

namespace App\Livewire\Proyectos;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Proyecto;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public string $nombre = '';
    public ?string $descripcion = null;

    protected function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:120'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function save()
    {
        $this->authorize('create', Proyecto::class);
        $data = $this->validate();
        auth()->user()->proyectos()->create($data);
        session()->flash('success', 'Proyecto creado correctamente.');
        
        return redirect()->route('proyectos.index');
    }

    public function render()
    {
        return view('livewire.proyectos.create');
    }
}
