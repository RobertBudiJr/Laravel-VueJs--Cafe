<?php

use Illuminate\Http\Request;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.verify']], function(){
    Route::group(['middleware' => ['api.manajer']], function(){
        // CRUD Transaksi
        Route::resource('/transaksi', TransaksiController::class);
        // CRUD Detail Transaksi
        Route::resource('/detail_transaksi', DetailTransaksiController::class);
    });

    Route::group(['middleware' => ['api.kasir']], function(){
        // CRUD Menu
        Route::resource('/menu', MenuController::class);
        // CRUD Meja
        Route::resource('/meja', MejaController::class);
        // Filter meja
        Route::post('/mejafilter', [MejaController::class, 'mejafilter']);
        // Transaksi
        Route::get('/transaksi', [TransaksiController::class, 'index']);
        Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);
    
        Route::post('/transaksi', [TransaksiController::class, 'create']);
        Route::put('/transaksis/{id}', [TransaksiController::class, 'update']);
    });

    Route::group(['middleware' => ['api.admin']], function(){
        // CRUD user
        Route::post('/register', [UserController::class, 'register']);
        Route::put('/user/{id}', [UserController::class, 'update']);
        Route::delete('/user/{id}', [UserController::class, 'destroy']);
        Route::get('/user', [UserController::class, 'show']);
    });
    
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

