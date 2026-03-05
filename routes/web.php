<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Proyectos\Index as ProyectosIndex;
use App\Livewire\Proyectos\Create as ProyectosCreate;
use App\Livewire\Proyectos\Edit as ProyectosEdit;
use App\Livewire\Tareas\Index as TareasIndex;
use App\Livewire\Tareas\Create as TareasCreate;
use App\Livewire\Tareas\Edit as TareasEdit;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
   
    Route::get('/proyectos', ProyectosIndex::class)->name('proyectos.index');
    Route::get('/proyectos/create', ProyectosCreate::class)->name('proyectos.create');
    Route::get('/proyectos/{proyecto}/edit', ProyectosEdit::class)->name('proyectos.edit');
    Route::get('/proyectos/{proyecto}/tareas', TareasIndex::class)->name('tareas.index');
    Route::get('/proyectos/{proyecto}/tareas/create', TareasCreate::class)->name('tareas.create');
    Route::get('/proyectos/{proyecto}/tareas/{tarea}/edit', TareasEdit::class)->name('tareas.edit');
    Route::view('profile', 'profile')->name('profile');
});
require __DIR__.'/auth.php';