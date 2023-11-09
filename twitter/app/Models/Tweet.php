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

class Tweet extends Model
{
    use HasFactory;

    protected $table = 'tweets';

    protected $fillable = [
        'id',
        'user_id',
        'tweet',
        'created_at',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public static function fetchById(int $tweets): View
    {
        return self::find($tweets);
    }

    /**
     * ツイートを登録
     *
     * @param string $tweet
     * @return void
     */
    public function store(string $tweet): void
    {
        $this->create([
            'user_id' => Auth::id(),
            'tweet' => $tweet,
        ]);
    }

    /**
     * 特定のツイートの情報を取得
     *
     * @param int $tweetId
     * @return Tweet|null
     */
    public function getTweetById($id): Tweet|null
    {
        // ツイートテーブルから指定したIDの情報を取得
        return Tweet::find($id);
    }

    /**
     * ツイートを更新
     *
     * @param string $tweetText
     * @param integer $tweetId
     * @return void
     */
    public function updateTweet(string $tweetText, int $id): void
    {
        // メソッドを呼び出して結果を取得
        $tweet = $this->getTweetById($id);

        $tweet->tweet = $tweetText;

        $tweet->update();
    }
}
