@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2>自分のtweet一覧</h2>
        <div class="col-md-8">
            <div class="card">
            @foreach($ownTweets as $ownTweet)
                <div class="card-body">
                <a href="{{ route('tweets.detail', ['id' => $ownTweet->id]) }}">{{$ownTweet->tweet}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{ route('tweets.favoriteList') }}">お気に入り一覧</a><br>
    <a href="/users">users</a><br>
    <a href="{{ route('tweets.tweetCreate') }}">ツイートする</a><br>
    <a href="{{ route('tweets.allTweets') }}">全ユーザーのtweet一覧</a>
</div>
@endsection