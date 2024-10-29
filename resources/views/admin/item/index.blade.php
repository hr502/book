@extends('admin.layouts.parents')
@section('title', '作品管理')
@section('content')
    @if (session('flash_message'))
        <div class="alert alert-success my-3">
            {{ session('flash_message') }}
        </div>
    @endif
    <h3 class="my-3">作品管理</h3>
    <div class="mb-3">
        <form class="row" method="get" action="{{ route('admin.item.index') }}">
            @csrf
            <div class="col-auto col-sm-5">
                <input class="form-control" type="text" name="keyword">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">検索</button>
            </div>
        </form>
    </div>
    <div class="mb-4">
        <form class="row" method="post" action="{{ route('admin.item.import') }}" enctype="multipart/form-data">
            @csrf
            <label class="mb-1" for="file">CSV入力</label>
            <div class="col-auto">
                <input class="form-control" id="file" type="file" accept=".csv" name="file">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary btn-sm d-inline ml-3" type="submit">アップロード</button>
            </div>
                @error('file')
                    <li class="err">{{ $message }}</li>
                @enderror
        </form>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="location.href='{{ route('admin.item.create') }}'">新規登録</button>
    </div>
    <table class="table table-striped " style="table-layout: fixed;">
        <thead>
            <tr>
                <th></th>
                <th>作品名</th>
                <th>著者/作成者</th>
                <th>出版社</th>
                <th>発売年月</th>
                <th>分類</th>
                <th>貸出可能総数</th>
                <th>在庫</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td><img class="img-thumbnail" src="{{ asset($item->file_path) }}"></td>
                    <td style="word-break: brark-all;">{{ $item->title }}</td>
                    <td style="word-break: brark-all;">{{ $item->author }}</td>
                    <td style="word-break: brark-all;">{{ $item->publisher }}</td>
                    <td style="word-break: brark-all;">{{ $item->published_on }}</td>
                    <td style="word-break: brark-all;">{{ $item->classification }}</td>
                    @if ($item->itemJans->isNotEmpty())
                        <td>{{ $item->itemJans->count() }}</td>
                        <td>{{ $item->available }}</td>
                    @else
                        <td>取り扱いなし</td>
                        <td> - </td>
                    @endif
                    <td><button
                            class="btn btn-primary btn-sm"onclick="location.href='{{ route('admin.item.show', $item->id) }}'">詳細</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $items->links() }}
    <form method="GET" action="{{ route('admin.item.export') }}">
        @csrf
        <button class="btn btn-primary" type="submit">データを出力</button>
    </form>
@endsection
