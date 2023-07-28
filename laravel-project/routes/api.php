<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileUploadContoller;

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


//画像アップロード
Route::post('fileupload', [FileUploadContoller::class, 'store']);

//アカウント作成
Route::post('/user/create', [UserController::class, 'store']);

//認証系
Route::post('/login', [UserController::class, 'login']);

Route::middleware('checktoken')->group(function () {
    
    Route::post('/user/update', [UserController::class, 'update']);
});
