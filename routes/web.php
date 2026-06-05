<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MouController;

// Route to view the dashboard
Route::get('/', [MouController::class, 'index'])->name('mous.index');

// Route to save a new MoU
Route::post('/mous', [MouController::class, 'store'])->name('mous.store');

// Route to delete an MoU
Route::delete('/mous/{mou}', [MouController::class, 'destroy'])->name('mous.destroy');