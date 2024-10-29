@extends('user.layouts.parents')
@section('title', 'ログイン')
@section('content')
    <form method="post" action="{{ route('login') }}">
        @csrf
        <p class="headline">メールアドレス</p>
        <input class="input" type="text" name="email">
        @error('email')
            <li class="err">{{ $message }}</li>
        @enderror
        <p class="headline">パスワード</p>
        <input class="input" type="password" name="password">
        @error('password')
        <li class="err">{{ $message }}</li>
        @enderror
        <div class="btn-container">
            <button class="btn submit" type="submit">ログイン</button>
        </div>
    </form>
@endsection
