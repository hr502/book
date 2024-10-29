@extends('admin.layouts.parents')
@section('title', '利用者詳細')
@section('content')
    @if (session('flash_message'))
        <div class="alert alert-success my-3">
            {{ session('flash_message') }}
        </div>
    @endif
    <h3 class="my-3">利用者詳細　　
        <span><button class="btn btn-primary"
                onclick="location.href='{{ route('admin.user.edit', $user->id) }}'">編集</button></span>
        <span>
            <form class="d-inline" method="post" action="{{ route('admin.user.destroy', $user->id) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </span>
    </h3>
    <table class="table table-striped table-bordered mb-5" style="table-layout:fixed;">
        <tr>
            <th style="width: 200px">JANコード</th>
            <td>{{ $user->jan }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">氏名</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">フリガナ</th>
            <td>{{ $user->name_kana }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">生年月日</th>
            <td>{{ $user->birth_date }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">電話番号</th>
            <td>{{ $user->phone_number }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">メールアドレス</th>
            @if ($user->email)
                <td>{{ $user->email }}</td>
            @else
                <td> - </td>
            @endif
        </tr>
    </table>
    <h5>利用履歴</h5>
    <table class="table table-striped mb-3" style="table-layout:fixed;">
        <thead>
            <tr>
                <th class="align-middle">タイトル / 著者・作成者
                </th>
                <th class="align-middle">貸出日時</th>
                <th class="align-middle">返却日時</th>
                <th class="align-middle">返却予定日</th>
            </tr>
        </thead>
        <tbody>
            @if ($lendings->isNotEmpty())
                @foreach ($lendings as $lending)
                    <tr>
                        <td>{{ $lending->title }}<br>
                            {{ $lending->author }}
                        </td>
                        <td>{{ $lending->checkout_at }}</td>
                        @if ($lending->return_at)
                            <td>{{ $lending->return_at }}</td>
                        @else
                            <td> - </td>
                        @endif
                        <td>{{ $lending->due_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-danger">利用履歴はありません。</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $lendings->links() }}
    <button class="btn btn-secondary mb-3" onclick="location.href='{{ route('admin.user.index') }}'">戻る</button>



@endsection
