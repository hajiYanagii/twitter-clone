@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2>他の全ユーザーのtweet一覧</h2>
        <div class="col-md-8">
            <div class="card">
            @foreach($tweets as $tweet)
                <div class="card-body">
                <a href="{{ route('tweets.detail', ['id' => $tweet->id]) }}">{{$tweet->tweet}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{ route('tweets.favoriteList') }}">お気に入り一覧</a><br>
    <a href="/users">users</a><br>
    <a href="{{ route('tweets.tweetCreate') }}">ツイートする</a><br>
    <a href="{{ route('tweets.index') }}">自身のtweet一覧</a>
</div>
@endsection