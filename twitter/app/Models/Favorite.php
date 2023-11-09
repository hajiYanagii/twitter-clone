<?php

namespace App\Models;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'id',
        'email',
        'tweet_id',
        'created_at',
        'updated_at',
];

public function user() {
    return $this->belongsTo(User::class);
}

public function tweet() {
    return $this->belongsTo(Tweet::class);
}

    //いいね一覧
    // public static function getAllByUserIds(int $userId): View
    // {
    //     return self::find($userId);
    // }

    //いいねされたか確認
    public static function getFavoriteByTweetIds(int $tweetId, $user): View
    {
        $favorite = Favorite::where('tweet_id', $tweetId)->where('user_id', $user->email)->first();
        return self::find($favorite);
    }

       /**
     * いいねを解除
     *
     * @param integer $tweetId
     * @return void
     */
    public function deleteLike(int $tweetId): void
    {
        $like = Favorite::where('user_id', Auth::user()->id)
                    ->where('tweet_id', $tweetId)
                    ->first();
 
        if ($like)
        {
            $like->delete();
        }
    }
}
