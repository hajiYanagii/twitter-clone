@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2>ユーザー詳細</h2>
        <div class="col-md-8">
            <div class="card">
             
                <div class="card-body">
                    {{$userId->name}}
                </div>
                <div class="card-body">
                    {{$userId->email}}
                </div>
            </div>
        </div>
        <a href="{{ route('users.index')}}">ユーザー一覧</a>
    </div>
</div>
@endsection