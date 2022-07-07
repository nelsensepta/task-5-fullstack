<?php

use Illuminate\Support\Facades\Route;
use Modules\V1\Http\Controllers\ArticleController;
use Modules\V1\Http\Controllers\CategoryController;

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

// Route::middleware('auth:api')->get('/v1', function (Request $request) {
//     return $request->user();
// });

// Route::group(["prefix" => "v1"], function () {
//     Route::get("/", function () {
//         return response()->json(["status" => 200, "message" => "Hello World"]);
//     });
// });

// Login
Route::group(["prefix" => "v1"], function () {
    Route::post("/login", "AuthController@login");
    Route::apiResource('/categories', CategoryController::class)->middleware("auth:api");
    Route::apiResource('/articles', ArticleController::class)->middleware("auth:api");
    // Route::post("/test", "AuthController@login");
    // Route::get('/', function () {
    //     return response([
    //         "status" => false,
    //         "message" => "Benar",
    //     ]);
    // });
    Route::get("/", "V1Controller@index")->middleware("auth:api");
});