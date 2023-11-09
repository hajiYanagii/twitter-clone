<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use宣言追加
use App\Models\Tweet;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //いいねする
    public function favorite(Tweet $tweet, Favorite $favorite, Request $request)
    {

        // ユーザーがログインしているかどうかを確認
        if (!Auth::check()) {
            return back()->with('error', 'Login required to like tweets');
        }

        $id = $request->id;
        $tweetId = Tweet::find($id);
        $favoriteId = Favorite::where('tweet_id', $tweetId);

        if ($favoriteId !== null) {
            $favorite->tweet_id = $tweetId->id; // ツイートのIDを取得
            $favorite->user_id = Auth::user()->id;
            $favorite->save(); // モデルのsave()メソッドを呼び出し、データベースに保存

        }
        return back();
    }

    /**
     * いいね解除
     *
     * @param integer $tweetId
     * @return RedirectResponse
     */
    public function unlike(int $tweetId): RedirectResponse
    {
        $user = Auth::user()->id;
        $favorite = Favorite::where('tweet_id', $tweetId)->where('user_id', $user)->first();
        $favorite->delete();

        return back();
    }

    /**
     * いいね一覧表示
     */
    public function favoriteList(Favorite $favorite, Tweet $tweet)
    {
        // dd($favorite);

        $user = Auth::user()->id;
        // $tweet = Tweet::all();
        // $favorites = Favorite::all();
        $favoriteTweets = Favorite::where('user_id', $user)->get();
        
        return view('tweets.favoriteList', compact('favoriteTweets'));
    }
}
