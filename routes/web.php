<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    dd('Welcome to the Multi-Tenant Application Tenant Id : '. \App\Helpers\Tenant\TenantSession::getTenantId());
});


Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');    
Route::get('/tasks-create', [TaskController::class, 'create'])->name('tasks.create');    
