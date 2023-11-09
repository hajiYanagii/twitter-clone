<?php

namespace App\Models;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Foundation\Auth\User;
// use Illuminate\Foundation\Auth\Favorite;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'replies';

    protected $fillable = [
        'id',
        'user_id',
        'tweet_id',
        'reply_comment',
        'created_at',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }

    public static function fetchById(int $tweetId): View
    {
        return self::find($tweetId);
    }

    /**
     * 返信を登録
     *
     * @param string $tweet
     * @return void
     */
    public function store(string $reply, int $tweetId): void
    {

        $this->create([
            'user_id' => Auth::id(),
            'tweet_id' => $tweetId,
            'reply_comment' => $reply,
        ]);
        
    }


    /**
     * コメントを更新
     *
     * @param string $tweetText
     * @param integer $tweetId
     * @return void
     */
    public function updateTweet(string $reply, int $tweetId): void
    {
        // メソッドを呼び出して結果を取得
        $tweet = $this->getTweetById($tweetId);

        $tweet->tweet = $reply;

        $tweet->update();
    }

}
