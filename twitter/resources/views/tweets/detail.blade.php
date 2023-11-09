@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2>tweets詳細</h2>
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    {{$tweet->id}}
                    {{$tweet->tweet}}
                </div>


                @if($tweet->user_id !== auth()->user()->id)

                <!-- もし$favoriteがあれば＝ユーザーが「いいね」をしていたら -->
                <!-- 「いいね」取消用ボタンを表示 -->
                @if($favorite !== null)
                <form action="{{ route('tweets.unlike', ['id' => $tweet->id]) }}" method="POST" class="">
                    @csrf
                    <button type="submit" class="liked">いいね解除</button>
                </form>
                @else
                <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                <form action="{{ route('tweets.favorite', ['id' => $tweet->id]) }}" method="POST" class="">
                    @csrf
                    <button type="submit" class="btn-liked">いいね</button>
                </form>
                @endif
                <a href="{{ route('tweets.replyPage', ['id' => $tweet->id]) }}" class="btn-edit">返信</a>

                @else
                <p>自分のツイートです</p>
                <a href="{{ route('tweets.edit', ['id' => $tweet->id]) }}" class="btn-edit">編集</a>
                @endif





                @foreach($replies as $reply)
                <div>
                    <p>返信：</p>
                    {{$reply->reply_comment}}
                </div>
                @endforeach
            </div>
        </div>
        <a href="{{ route('tweets.index')}}">tweets一覧</a>
    </div>
</div>
@endsection