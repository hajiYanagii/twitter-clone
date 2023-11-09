<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Http\Requests\Tweet\DetailRequest;
use App\Http\Requests\TweetRequest;
use App\Models\Favorite;
use App\Models\Reply;
use App\Models\Tweet;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TweetController extends Controller
{
    //つぶやくページ表示
    public function store()
    {
        return view('tweets.tweetCreate');
    }

    /**
     * ツイートを登録
     *
     * @param TweetRequest $request
     * @return RedirectResponse
     */
    public function create(TweetRequest $request): RedirectResponse
    {
        // ツイートモデルインスタンスの作成
        $tweetModel = new Tweet();

        // 新規ツイートの登録
        $tweetModel->store($request->tweet);

        return redirect(route('tweets.index'));
    }

    /**
     * ツイート編集画面を表示
     *
     * @param integer $tweetId
     * @return View
     */
    public function edit(int $tweetId): View
    {
        $tweetModel = new Tweet();

        $tweet = $tweetModel->getTweetById($tweetId);

        return view('tweets.edit', compact('tweet'));
    }

    /**
     * 編集されたツイートを更新
     *
     * @param TweetRequest $request
     * @param integer $tweetId
     * @return RedirectResponse
     */
    public function update(TweetRequest $request, int $tweetId): RedirectResponse
    {
        // リクエストから必要なデータを抽出
        $tweetText = $request->input('tweet');

        $tweetModel = new Tweet();

        // ツイートのユーザーIDとログインユーザーのIDを比較
        if (Auth::id() !== $tweetModel->getTweetById($tweetId)->user_id) {
            return redirect(route('tweets.index'))->with('error', 'You do not have permission to update this tweet.');
        }

        $tweetModel->updateTweet($tweetText, $tweetId);

        return redirect(route('tweets.index'))->with('success', 'Tweet updated successfully.');
    }


    //自身のtweet一覧表示
    public function index()
    {
        $ownTweets = Tweet::where('user_id', auth()->user()->id)->get();

        return view('tweets.index', compact('ownTweets'));
    }

    //tweet一覧表示
    public function allTweets()
    {
        $user_id = Auth::id();
        $tweets = Tweet::where('user_id', '!=', $user_id)->get();

        return view('tweets.allTweets', compact('tweets'));
    }

    /**
     * 詳細表示
     */
    public function detail(DetailRequest $request, Tweet $tweet, User $user, Favorite $favorite)

    {
        $id = $request->id;
        $tweet = Tweet::where('id', $id)->first();
        $tweetId = Tweet::find($id);
        $favorite = Favorite::where('tweet_id', $id)->first();
        $replies = Reply::where('tweet_id', $id)->get();

        return view('tweets.detail', compact('tweetId', 'tweet', 'favorite', 'replies'));
    }
}
