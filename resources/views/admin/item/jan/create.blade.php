@extends('admin.layouts.parents')
@section('title', 'JAN登録')
@section('content')
    <form method="post" action="{{ route('admin.item.jan.store', $item->id) }}">
        @csrf
        <div class="col-sm-6 mt-4 mb-3">
            <label for="jan" class="mb-1"><span class="badge bg-danger">必須</span> JANコード</label>
            <input class="form-control mb-2" id="jan" type="text" name="jan" value="{{ old('jan') }}">
            @error('jan')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="read-only" name="read-only">
            <label class="form-check-label" for="read-only">禁帯出</label>
        </div>
        <button class="btn btn-secondary"type="button"
            onclick="location.href='{{ route('admin.item.show', $item->id) }}'">戻る</button>
        <button class="btn btn-primary" type="submit">登録</button>
    </form>
@endsection
