@extends('admin.layouts.parents')
@section('title', '取置管理')
@section('content')
    <h3>取置管理</h3>
    @if (!$keeps->isEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>作品名</th>
                    <th>著者/作成者</th>
                    <th>JANコード</th>
                    <th>予約者</th>
                    <th>貸出券JAN</th>
                    <th>電話番号</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keeps as $keep)
                <tr>
                    <td>{{ $keep->item_jan->item->title }}</td>
                    <td>{{ $keep->item_jan->item->author }}</td>
                    <td>{{ $keep->item_jan }}</td>
                    @if (!$keep->user)
                    <td>{{ $keep->user->name }}</td>
                    <td>{{ $item->user->jan }}</td>
                    <td>{{ $item->user->phone_number }}</td>
                    <td><td>
                    @else
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td>
                        @if ($jan->status->id === 1)
                        <form method="post" action="{{ route('admin.item.keep.destroy', [$item->id, $keep->id])}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $keeps->links() }}
    @else
        <p>取置データはありません。<p>
    @endif
@endsection
