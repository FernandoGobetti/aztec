<?php

use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/listacompras', ShoppingController::class);
    Route::post('/listacompras/{listacompra}/duplicate', [ShoppingController::class, 'duplicate']);

    Route::get('/listacompras/{listacompra}/products', [ProductController::class, 'index']);
    Route::post('/listacompras/{listacompra}/products', [ProductController::class, 'addproductlist']);
    Route::delete('/listacompras/{listacompra}/products/{product}', [ProductController::class, 'deleteproductlist']);


    Route::patch('/product/{product}', [ProductController::class, 'changeQtyProduct']);
});


Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);
    if (Auth::attempt($credentials) === false){
        return response()->json('Unauthorized', 401);
    }

    $user = Auth::user();
    $token = $user->createToken('token');
    return response()->json($token->plainTextToken);
});