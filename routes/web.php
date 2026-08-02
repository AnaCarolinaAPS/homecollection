<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaProdutoController;
use App\Http\Controllers\ProdutoController;

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

    // Rotas para gerenciamento de Categoria de Produtos
    Route::prefix('/categoriaProduto')->group(function () {
        Route::get('/', [CategoriaProdutoController::class, 'index'])->name('categoriaProduto.index');
        Route::post('/', [CategoriaProdutoController::class, 'store'])->name('categoriaProduto.store');
        Route::get('/{categoriaProduto}', [CategoriaProdutoController::class, 'show'])->name('categoriaProduto.show');
        Route::put('/{categoriaProduto}', [CategoriaProdutoController::class, 'update'])->name('categoriaProduto.update');
        Route::delete('/{categoriaProduto}', [CategoriaProdutoController::class, 'destroy'])->name('categoriaProduto.destroy');
    });

    // Rotas para gerenciamento de Produtos
    Route::prefix('/produto')->group(function () {
        Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
        Route::post('/', [ProdutoController::class, 'store'])->name('produto.store');
        Route::get('/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
        Route::put('/{produto}', [ProdutoController::class, 'update'])->name('produto.update');
        Route::delete('/{produto}', [ProdutoController::class, 'destroy'])->name('produto.destroy');
    });

});

require __DIR__.'/auth.php';
