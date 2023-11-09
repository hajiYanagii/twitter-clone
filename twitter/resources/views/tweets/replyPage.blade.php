@extends('layouts.app')

@section('content')

<div class="container">
    <h2>返信</h2>
    <form action="{{ route('tweets.reply', ['id' => $tweet[0]->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="tweet_id" value="{{ $tweet[0]->id }}">
        <input name="reply_comment" type="text" value="{{ old('reply') }}" placeholder="コメントする">
        <button type="submit">返信する</button>
    </form>

    <a href="{{ route('tweets.index') }}">tweet一覧</a><br>
</div>

@endsection