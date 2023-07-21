<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('contatos', [ApiController::class, 'obterContatos']);
Route::get('contatos/{codigo}', [ApiController::class, 'obterContato']);

Route::post('contatos', [ApiController::class, 'cadastrarContato']);

Route::put('contatos/{codigo}', [ApiController::class, 'atualizarContato']);

Route::delete('contatos/{codigo}', [ApiController::class, 'apagarContato']);

