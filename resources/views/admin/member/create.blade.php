@extends('admin.layouts.parents')
@section('title', '従業員登録')
@section('content')
    <h3 class="my-3">従業員登録</h3>
    <form method="post" action="{{ route('admin.member.store') }}">
        @csrf
        <div class="col-sm-6 mt-4 mb-3">
            <label for="name" class="mb-1"><span class="badge bg-danger">必須</span>  氏名</label>
            <input class="form-control mb-2" id="name" type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="jan" class="mb-1"><span class="badge bg-danger">必須</span>  JANコード</label>
            <input class="form-control mb-2" id="jan" type="text" name="jan" value="{{ old('jan') }}">
            @error('jan')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="password" class="mb-1"><span class="badge bg-danger">必須</span>  パスワード</label>
            <input class="form-control mb-2" id="password" type="password" name="password">
            @error('password')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="password_confirmation" class="mb-1"><span class="badge bg-danger">必須</span>  パスワード（確認）</label>
            <input class="form-control mb-2" id="password_confirmation" type="password" name="password_confirmation">
            @error('password_confirmation')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-4">
            <label for="role" class="mb-1"><span class="badge bg-danger">必須</span>  役職</label>
            <select class="form-select" id="role" name="role">
                <option value="">選択してください</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if($role->id == old('role')) selected @endif>{{ $role->position }}</option>
                @endforeach
            </select>
            @error('role')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('admin.member.index') }}'">キャンセル</button>
        <button class="btn btn-primary" type="submit">登録</button>
    </form>
@endsection
