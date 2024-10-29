@extends('admin.layouts.parents')
@section('title', 'ログイン')
@section('content')
<div class="container">
    <form method="post" action="{{ route('admin.login') }}">
        @csrf
        <h3 class="my-3">Login</h3>
        @foreach ($errors->all() as $error)
            <li class="list-unstyled text-danger">{{ $error }}</li>
        @endforeach
        <div class="form-group col-sm-6">
        <div class="mb-2 form-group">
            <label for="jan" class="mb-1">JANコード</label>
            <input class="form-control" type="text" name="jan" id="jan">
        </div>
        <div class="mb-4 form-group">
            <label for="password" class="mb-1">パスワード</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
    </div>
        <button class="btn btn-primary" type="submit">ログイン</button>
    </form>
</div>
@endsection
