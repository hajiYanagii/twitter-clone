<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    //返信ページ表示
    public function replyPage(int $id)
    {

        $tweet = Tweet::where('id', $id)->get();
        // $reply = Reply::with($tweetId);
        $reply = Reply::where('tweet_id', $id)->get();


        return view('tweets.replyPage', compact('reply', 'tweet'));
    }

    /**
     * 返信
     *
     * @param ReplyRequest $request
     * @return RedirectResponse
     */
    public function reply(ReplyRequest $request, int $tweetId): RedirectResponse
    {

        // リプライモデルインスタンスの作成
        $replyModel = new Reply();

        // 新規リプライの登録
        $replyModel->store($request->reply_comment, $request->tweet_id);

        return redirect(route('tweets.index'));
    }
}
