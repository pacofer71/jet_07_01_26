<?php

use App\Livewire\MostrarCategorias;
use App\Livewire\ShowUserPosts;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts=Post::with('category', 'user')->where('estado', 'Publicado')->paginate(5);
    return view('welcome', compact('posts'));
})->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Rutas que es necesario estar logueado!!!
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('categorias', MostrarCategorias::class)->name('categorias.show');
    Route::get('posts', ShowUserPosts::class)->name('posts.show');
});
