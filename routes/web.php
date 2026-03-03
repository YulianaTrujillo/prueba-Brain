<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Livewire\Proyectos\Index as ProyectosIndex;
use App\Livewire\Proyectos\Create as ProyectosCreate;
use App\Livewire\Proyectos\Edit as ProyectosEdit;
Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
   
    Route::get('/proyectos', ProyectosIndex::class)->name('proyectos.index');
    Route::get('/proyectos/create', ProyectosCreate::class)->name('proyectos.create');
    Route::get('/proyectos/{proyecto}/edit', ProyectosEdit::class)->name('proyectos.edit');
    
    Route::view('profile', 'profile')->name('profile');
});
require __DIR__.'/auth.php';