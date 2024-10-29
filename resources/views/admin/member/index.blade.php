@extends('admin.layouts.parents')
@section('title', '従業員登録')
@section('content')
    @if (session('flash_message'))
        <div class="alert alert-success my-3">
            {{ session('flash_message') }}
        </div>
    @endif
    <h3 class="my-3">従業員管理</h3>
    <button class="btn btn-primary mb-2" onclick="location.href='{{ route('admin.member.create') }}'">新規登録</button>
    <table class="table table-striped" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>氏名</th>
                <th>従業員コード</th>
                <th>役職</th>
                <th>更新日</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->jan }}</td>
                    <td>
                        <span
                            class="badge @if ($admin->role_id == 1) bg-primary @else bg-success @endif">{{ $admin->role->position }}</span>
                    </td>
                    <td>{{ $admin->updated_at }}</td>
                    <td><button class="btn btn-primary btn-sm"
                            onclick="location.href='{{ route('admin.member.edit', $admin->id) }}'">編集</button></td>
                    <td>
                        <form method="post" action="{{ route('admin.member.destroy', $admin->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-secondary" onclick="location.href='{{ route('admin.index') }}'">戻る</button>
@endsection
