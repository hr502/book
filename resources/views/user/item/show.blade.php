@extends('user.layouts.parents')
@section('title', '作品詳細')
@section('content')
    <img class="item-image" src="{{ asset($item->file_path) }}">
    <p class="">{{ $item->title }}</p>
    <p class="">{{ $item->detail }}</p>
    @if($is_reserve)
        <form method="post" action="{{ route('user.item.cancel', $item->id)}}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-danger" onclick="return confirm('予約を取り消しますか?')">この本の予約を取り消す</button>
        </form>
    @else
        <form method="post" action="{{ route('user.item.reserve', $item->id)}}">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('予約しますか?')">この本を予約する</button>
        </form>
    @endif
        <div class="col-4">
            <button class="btn btn-primary" onclick="location.href='{{ route('user.index') }}'">戻る</button>
        </div>
    </div>
