<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileUploadContoller;
use App\Http\Controllers\LifeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;

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

//認証
Route::post('/login', [UserController::class, 'login']);

Route::middleware('checktoken')->group(function () {

    //ユーザアップデート
    Route::post('/user/update', [UserController::class, 'update']);
    //人生とコメントの取得
    Route::get('/user/life', [LifeController::class, 'getLifeWithComments']);
    
    //他ユーザの人生とコメントの取得
    Route::post('/otheruser/lifes', [LifeController::class, 'getOtherLifeWithComments']);

    //人生とマスの作成
    Route::post('/createLifeAndTrout', [LifeController::class, 'storeLifeAndCell']);
    //人生とマスの修正
    Route::post('/updateLifeAndTrout', [LifeController::class, 'updateLifeAndCell']);
    //Good追加
    Route::post('/life/good', [LifeController::class, 'incrementGood']);

    //コメントの作成
    Route::post('comment/create', [CommentController::class, 'store']);

    //通知取得
    Route::get('/notifications', [NotificationController::class, 'getNotifications']);
});
