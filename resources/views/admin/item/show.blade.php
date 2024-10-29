@extends('admin.layouts.parents')
@section('title', '作品管理')
@section('content')
    @if (session('flash_message'))
        <div class="alert alert-success my-3">
            {{ session('flash_message') }}
        </div>
    @endif
    <h3 class="my-3">作品詳細　　
        <span><button class="btn btn-primary"
                onclick="location.href='{{ route('admin.item.edit', $item->id) }}'">編集</button></span>
        <span>
            <form class="d-inline" method="post" action="{{ route('admin.item.destroy', $item->id) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </span>
    </h3>
    <img class="img-thumbnail mb-2" style="height: 200px;" src="{{ asset($item->file_path) }}"></th>
    <table class="table table-striped table-bordered mb-5" style="table-layout:fixed;">
        <tr>
            <th style="width: 200px;">タイトル</th>
            <td style="word-break: brark-all;">{{ $item->title }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">著者/作成者</th>
            <td style="word-break: brark-all;">{{ $item->author }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">シリーズ</th>
            <td style="word-break: brark-all;">{{ $item->series }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">作品詳細</th>
            <td style="word-break: brark-all;">{{ $item->detail }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">種別</th>
            <td style="word-break: brark-all;">{{ $type->name }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">分類</th>
            <td style="word-break: brark-all;">{{ $item->classification }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">出版社</th>
            <td style="word-break: brark-all;">{{ $item->publisher }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">発売年月</th>
            <td style="word-break: brark-all;">{{ $item->published_on }}</td>
        </tr>
        <tr>
            @if ($type->id === 8)
                <th style="width: 200px;">雑誌コード</th>
            @elseif($type->id === 7 || $type->id === 9 || $type->id === 10)
                <th style="width: 200px;">品番</th>
            @else
                <th style="width: 200px;">ISBNコード</th>
            @endif
            <td style="word-break: brark-all;">{{ $item->code }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">価格</th>
            <td style="word-break: brark-all;">{{ $item->price }}円</td>
        </tr>
        <tr>
            <th style="width: 200px;">登録日時</th>
            <td style="word-break: brark-all;">{{ $item->created_at }}</td>
        </tr>
        <tr>
            <th style="width: 200px;">更新日時</th>
            <td style="word-break: brark-all;">{{ $item->updated_at }}</td>
        </tr>
    </table>
    <h5>JANコード一覧　　<span><button class="btn btn-primary btn-sm mb-2"
                onclick="location.href='{{ route('admin.item.jan.create', $item->id) }}'">JAN登録</button></span></h5>
    @if ($item->itemJans->isNotEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>janコード</th>
                    <th>ステータス</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item->itemJans as $jan)
                    <tr>
                        <td>{{ $jan->jan }}</td>
                        <td>
                            @switch($jan->status->id)
                                @case(1)
                                    <span class="badge bg-primary">{{ $jan->status->name }}</span>
                                @break

                                @case(2)
                                    <span class="badge bg-warning">{{ $jan->status->name }}</span>
                                @break

                                @case(3)
                                    <span class="badge bg-danger">{{ $jan->status->name }}</span>
                                @break

                                @default
                                    <span class="badge bg-secondary">{{ $jan->status->name }}</span>
                                @break
                            @endswitch
                        </td>
                        <td>
                            @if ($jan->status->id === 1 || $jan->status->id === 9)
                                <form method="post" action="{{ route('admin.item.jan.destroy', [$item->id, $jan->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('本当に削除しますか？')">削除</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
            <p class="text-danger mb-3">　館内に所蔵がありません</p>
    @endif






    <button class="btn btn-secondary mb-3" onclick="location.href='{{ route('admin.item.index') }}'">戻る</button>

@endsection
