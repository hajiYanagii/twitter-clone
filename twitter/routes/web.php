<?php

// use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// 認証済みRoute
Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // user一覧の表示
    Route::get('/users/follow', [UserController::class, 'follow'])->name('users.follow'); // フォローしているの表示
    Route::get('/users/follower', [UserController::class, 'follower'])->name('users.follower'); // フォローされた人の表示
    Route::get('/users/{id}', [UserController::class, 'detail'])->name('users.detail'); // user詳細の表示
    Route::post('/users', [UserController::class, 'create'])->name('users.create'); // userの作成
    Route::post('/users/follow/{id}', [UserController::class, 'follow'])->name('users.follow'); // フォローする
    Route::put('/users', [UserController::class, 'update'])->name('users.update'); // userの更新
    Route::delete('/users', [UserController::class, 'delete'])->name('users.delete'); // userの削除
    Route::get('/followerTweets', [TweetController::class, 'followerTweets'])->name('tweets.followerTweets'); // フォローしている人たちのtweets一覧の表示
    // いいね関連
    Route::get('/tweets/favoriteList', [FavoriteController::class, 'favoriteList'])->name('tweets.favoriteList'); // いいね一覧表示
    Route::post('/tweets/favorite', [FavoriteController::class, 'favorite'])->name('tweets.favorite');
    Route::post('/tweets/unlike/{id}', [FavoriteController::class, 'unlike'])->name('tweets.unlike');

    Route::get('/tweets/tweetCreate', [TweetController::class, 'store'])->name('tweets.tweetCreate'); // ツイート作成画面を表示
    Route::get('/tweets', [TweetController::class, 'index'])->name('tweets.index'); // tweets一覧の表示
    Route::get('/allTweets', [TweetController::class, 'allTweets'])->name('tweets.allTweets'); // tweets一覧の表示
    Route::get('/tweets/{id}/edit', [TweetController::class, 'edit'])->name('tweets.edit'); // tweet編集画面
    Route::get('/tweets/{id}', [TweetController::class, 'detail'])->name('tweets.detail'); // tweets詳細の表示
    Route::post('/tweets/tweetCreate', [TweetController::class, 'create'])->name('tweets.tweetCreate');  // ツイートを作成
    Route::post('/tweets/{id}/edit', [TweetController::class, 'update'])->name('tweets.update');  // tweet更新
    Route::delete('/tweets/{id}', [TweetController::class, 'delete'])->name('tweets.delete'); // tweetの削除

    Route::get('/tweets/{id}/reply', [ReplyController::class, 'replyPage'])->name('tweets.replyPage'); //　tweet返信画面
    Route::post('/tweets/{id}/reply', [ReplyController::class, 'reply'])->name('tweets.reply'); //　tweet返信
});

Route::get('/', function () {
    return view('auth.login');
});


Route::fallback(function () {
    return redirect(route('tweets.index'));
});
