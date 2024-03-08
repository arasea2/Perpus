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
Route::get('listBuku', [ApiController::class, 'bookList']);
Route::get('/kelompok/{status}/{id_users}', [ApiController::class, 'kelompok']);
Route::get('listPinjaman/{id}', [ApiController::class, 'listPinjaman']);
Route::get('infoboxapi', [ApiController::class, 'infoBox']);
Route::get('cartinfo/{id}/get', [ApiController::class, 'cartInfo']);