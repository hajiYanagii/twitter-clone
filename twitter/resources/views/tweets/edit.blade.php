@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Tweet編集</h2>
    <form action="{{ route('tweets.update', ['id' => $tweet->id]) }}" method="POST">
        @csrf
        <input name="tweet" type="text" value="{{ $tweet->tweet }}">
        <button type="submit">修正を保存</button>
    </form>

    <a href="{{ route('tweets.index') }}">tweet一覧</a><br>
</div>

@endsection