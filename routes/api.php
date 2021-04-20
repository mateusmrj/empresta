<?php

use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\SimuladorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/simulador', [SimuladorController::class, 'store']);

Route::get('/instituicoes', [InstituicaoController::class, 'index']);

Route::get('/convenios', [ConvenioController::class, 'index']);

// Route::get('/convenios', function(){
//     return Storage::disk('local')->get('Data/convenios.json');
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
