@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ route('tweets.tweetCreate') }}" method="POST">
        @csrf
        <input name="tweet" type="text" value="{{ old('tweet') }}" placeholder="今何してる？">
        <button type="submit">つぶやく</button>
    </form>
    <a href="{{ route('tweets.index') }}">tweet一覧</a><br>
</div>

@endsection