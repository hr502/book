@extends('user.layouts.parents')
@section('title', 'トップページ')
@section('content')
    <h3>作品一覧</h3>
    <div>
        <form method="get" action="{{ route('user.index')}}">
            @csrf
            <input type="text" name="keyword">
            <input type="submit" value="検索">
        </form>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>作品名</th>
                <th>著者/作成者</th>
                <th>出版社</th>
                <th>発売年月</th>
                <th>分類</th>
                <th>取り扱い</th>
                <th>在庫</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td><img class="img-thumbnail" src="{{ asset($item->file_path) }}"></td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->publisher }}</td>
                <td>{{ $item->published_on }}</td>
                <td>{{ $item->classification }}</td>
                @if($item->itemJans->isNotEmpty())
                    <td> あり</td>
                    @if($item->available > 0)
                        <td> ○ </td>
                    @else
                        <td> × </td>
                    @endif
                @else
                    <td> なし </td>
                    <td> - </td>
                @endif
                <td><button class="btn btn-primary btn-sm" onclick="location.href='{{ route('user.item.show', $item->id) }}'">詳細</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$items->links()}}
@endsection
