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
        // Watch Menu
        Route::get('manajer/menu', [MenuController::class, 'index']);
        Route::get('manajer/menu/{id}', [MenuController::class, 'show']);

        // Watch Transaksi
        Route::get('manajer/transaksi', [TransaksiController::class, 'index']);
        Route::get('manajer/transaksi/{id}', [TransaksiController::class, 'show']);
    });

    Route::group(['middleware' => ['api.kasir']], function(){
        // Watch Menu
        Route::get('kasir/menu', [MenuController::class, 'index']);
        Route::get('kasir/menu/{id}', [MenuController::class, 'show']);
        
        // Watch Meja
        Route::get('kasir/meja', [MejaController::class, 'index']);
        Route::get('kasir/meja/{id}', [MejaController::class, 'show']);
        Route::put('kasir/meja/{id}', [MejaController::class, 'update']);
        
        // Filter meja
        Route::post('kasir/mejafilter', [MejaController::class, 'mejafilter']);
        
        // CRU Transaksi
        Route::get('kasir/transaksi', [TransaksiController::class, 'index']);
        Route::get('kasir/transaksi/{id}', [TransaksiController::class, 'show']);
        Route::post('kasir/transaksi', [TransaksiController::class, 'create']);
        Route::put('kasir/transaksi/{id}', [TransaksiController::class, 'update']);

        // Filter transaksi
        Route::post('kasir/statusfilter', [TransaksiController::class, 'statusfilter']);
    });

    Route::group(['middleware' => ['api.admin']], function(){
        // CRUD User
        Route::post('admin/register', [UserController::class, 'register']);
        Route::put('admin/user/{id}', [UserController::class, 'update']);
        Route::delete('admin/user/{id}', [UserController::class, 'destroy']);
        Route::get('admin/user', [UserController::class, 'index']);
        Route::get('admin/user/{id}', [UserController::class, 'show']);

        // CRUD Meja
        Route::get('admin/meja', [MejaController::class, 'index']);
        Route::get('admin/meja/{id}', [MejaController::class, 'show']);
        Route::post('admin/meja', [MejaController::class, 'store']);
        Route::put('admin/meja/{id}', [MejaController::class, 'update']);
        Route::delete('admin/meja/{id}', [MejaController::class, 'destroy']);
        
        // CRUD Menu
        Route::get('admin/menu', [MenuController::class, 'index']);
        Route::get('admin/menu/{id}', [MenuController::class, 'show']);
        Route::post('admin/menu', [MenuController::class, 'store']);
        Route::put('admin/menu/{id}', [MenuController::class, 'update']);
        Route::delete('admin/menu/{id}', [MenuController::class, 'destroy']);
    });
    
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

