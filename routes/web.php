<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\{SupportController};
use App\Http\Controllers\Admin\{ReplySupportController};

Route::get('/', function () {
  return view('welcome');
});


Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/supports/{id}/replies', [ReplySupportController::class, 'index'])->name('replies.index');
  Route::post('/supports/{id}/replies', [ReplySupportController::class, 'store'])->name('replies.store');
  Route::delete('/supports/{id}/replies/{reply}', [ReplySupportController::class, 'destroy'])->name('replies.destroy');

  Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');
  Route::get('/supports/create', [SupportController::class, 'create'])->name('supports.create');
  Route::post('/supports/store', [SupportController::class, 'store'])->name('supports.store');
  Route::get('/supports/{id}/edit', [SupportController::class, 'edit'])->name('supports.edit');
  Route::put('/supports/{id}', [SupportController::class, 'update'])->name('supports.update');
  Route::delete('/supports/{id}', [SupportController::class, 'destroy'])->name('supports.destroy');

});

require __DIR__ . '/auth.php';
