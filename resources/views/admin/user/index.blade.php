@extends('admin.layouts.parents')
@section('title', '利用者管理')
@section('content')
    @if (session('flash_message'))
        <div class="alert alert-success my-3">
            {{ session('flash_message') }}
        </div>
    @endif
    <h3 class="my-3">利用者管理</h3>
    <button class="btn btn-primary mb-2" onclick="location.href='{{ route('admin.user.create') }}'">新規登録</button>
    <table class="table table-striped" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>氏名</th>
                <th>貸出券番号</th>
                <th>メールアドレス登録</th>
                <th>更新日</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->jan }}</td>
                    @if ($user->email)
                        <td>あり</td>
                    @else
                        <td>なし</td>
                    @endif
                    <td>{{ $user->updated_at }}</td>
                    <td><button class="btn btn-primary btn-sm"
                            onclick="location.href='{{ route('admin.user.show', $user->id) }}'">詳細</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
    <button class="btn btn-secondary" onclick="location.href='{{ route('admin.index') }}'">戻る</button>
@endsection
