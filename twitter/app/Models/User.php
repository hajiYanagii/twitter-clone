<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function tweet() {
        return $this->hasMany('App\Models\Tweet');
    }
 
    public function favorites() {
        return $this->hasMany('App\Models\Favorite');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public $timestamps = ['created_at', 'updated_at'];


    /**
     * userItemに紐づいた情報を取得する。
     *
     * @param int $userItem
     * @return self
     */
    public static function fetchById(int $userItem): View
    {
        return self::find($userItem);
    }

    /**
     *
     *　新規登録
     */
    public static function signup (): View
    {
        return self::find();
    }

}
