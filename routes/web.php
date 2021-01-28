<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('veiculos', '\App\Http\Controllers\VeiculosController');
    Route::get('veiculos/disponibilidade/{veiculo}/', [\App\Http\Controllers\VeiculosController::class, 'disponibilidade'])->name("veiculos.disponibilidade");
    Route::resource('usuarios', '\App\Http\Controllers\UsersController');
    Route::get("/reservas", [\App\Http\Controllers\ReservasController::class, 'index'])->name("reservas.index");
    Route::get("/reservas/alugar", [\App\Http\Controllers\ReservasController::class, 'getAlugarVeiculo'])->name("reservas.alugar");
    Route::post("/reservas/alugar", [\App\Http\Controllers\ReservasController::class, 'postAlugarVeiculo'])->name("reservas.alugar");
    Route::post("/reservas/devolver", [\App\Http\Controllers\ReservasController::class, 'devolverVeiculo'])->name("reservas.devolver");

});

Route::get("/auth/login", [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.index');
Route::post("/auth/login", [\App\Http\Controllers\AuthController::class, 'postLogin'])->name('auth.post');
Route::get("/auth/logout", [\App\Http\Controllers\AuthController::class, 'logout'])->name("auth.logout");
