@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2>user一覧</h2>
        <div class="col-md-8">
            <div class="card">
                @foreach($users as $user)
                <div class="card-body">
                    <a href="{{ route('users.detail', ['id' => $user->id]) }}">{{$user->name}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="/tweets">tweets</a>
</div>
@endsection