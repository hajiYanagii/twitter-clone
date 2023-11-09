@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2>いいね一覧</h2>
        <div class="col-md-8">
            <div class="card">

                @foreach($favoriteTweets as $favoriteTweet)
                <div class="card-body">
                    <a href="{{ route('tweets.detail', ['id' => $favoriteTweet->tweet_id]) }}">{{$favoriteTweet->tweet->tweet}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="/users">users</a>
</div>
@endsection