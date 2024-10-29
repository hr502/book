@extends('admin.layouts.parents')
@section('title', '利用者編集')
@section('content')
    <h3 class="my-3">利用者編集</h3>
    <form method="post" action="{{ route('admin.user.update', $user->id) }}">
        @csrf
        @method('PATCH')
        <div class="col-sm-6 mt-4 mb-3">
            <label for="jan" class="mb-1"><span class="badge bg-danger">必須</span> JANコード</label>
            <input class="form-control mb-2" id="jan" type="text" name="jan" value="{{ old('jan', $user->jan) }}">
            @error('jan')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="name" class="mb-1"><span class="badge bg-danger">必須</span> 氏名</label>
            <input class="form-control mb-2" id="name" type="text" name="name"
                value="{{ old('name', $user->name) }}">
            @error('name')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="name_kana" class="mb-1"><span class="badge bg-danger">必須</span> フリガナ</label>
            <input class="form-control mb-2" id="name_kana" type="text" name="name_kana"
                value="{{ old('name_kana', $user->name_kana) }}">
            @error('name_kana')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="birth_date" class="mb-1"><span class="badge bg-danger">必須</span> 生年月日</label>
            <input class="form-control mb-2" id="birth_date" type="text" name="birth_date"
                value="{{ old('birth_date', $user->birth_date) }}">
            @error('birth_date')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="phone-number" class="mb-1"><span class="badge bg-danger">必須</span> 電話番号</label>
            <input class="form-control mb-2" id="phone-number" type="text" name="phone_number"
                value="{{ old('phone_number', $user->phone_number) }}">
            @error('phone_number')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="email" class="mb-1">メールアドレス</label>
            <input class="form-control mb-2" id="email" type="text" name="email"
                value="{{ old('email', $user->email) }}">
            @error('email')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="password" class="mb-1">パスワード</label>
            <input class="form-control mb-2" type="password" name="password">
            @error('password')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-4">
            <label for="password_confirmation" class="mb-1">パスワード（確認）</label>
            <input class="form-control mb-2" id="password_confirmation" type="password" name="password_confirmation">
            @error('password_confirmation')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <button class="btn btn-secondary mb-3" type="button"
            onclick="location.href='{{ route('admin.user.show', $user->id) }}'">キャンセル</button>
        <button class="btn btn-primary mb-3" type="submit">更新</button>
    </form>
@endsection
