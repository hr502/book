@extends('admin.layouts.parents')
@section('title', '作品登録')
@section('content')
    <h3 class="my-3">作品登録</h3>
    <form method="post" action="{{ route('admin.item.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-sm-6 mt-4 mb-3">
            <label for="title" class="mb-1"><span class="badge bg-danger">必須</span> タイトル</label>
            <input class="form-control mb-2" id="title" type="text" name="title" value="{{ old('title')}}">
            @error('title')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="author" class="mb-1"><span class="badge bg-danger">必須</span> 著者/作成者</label>
            <input class="form-control mb-2" id="author" type="text" name="author" value="{{ old('author')}}">
            @error('author')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="publisher" class="mb-1"><span class="badge bg-danger">必須</span> 出版社</label>
            <input class="form-control mb-2" id="publisher" type="text" name="publisher" value="{{ old('publisher')}}">
            @error('publisher')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="series" class="mb-1">シリーズ</label>
            <input class="form-control mb-2" id="series" type="text" name="series" value="{{ old('series')}}">
            @error('series')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="detail" class="mb-1"><span class="badge bg-danger">必須</span> 作品詳細</label>
            <textarea class="form-control mb-2" id="detail" type="text" name="detail">{{ old('detail')}}</textarea>
            @error('detail')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="published_on" class="mb-1"><span class="badge bg-danger">必須</span> 発売年月</label>
            <input class="form-control mb-2" id="published_on" type="text" name="published_on" value="{{ old('published_on')}}">
            @error('published_on')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="classification" class="mb-1"><span class="badge bg-danger">必須</span> 分類</label>
            <input class="form-control mb-2" id="classification" type="text" name="classification" value="{{ old('classification')}}">
            @error('classification')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="code" class="mb-1"><span class="badge bg-danger">必須</span> ISBNコード等</label>
            <input class="form-control mb-2" id="code" type="text" name="code" value="{{ old('code')}}">
            @error('code')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="price" class="mb-1"><span class="badge bg-danger">必須</span> 価格</label>
            <input class="form-control mb-2" id="price" type="text" name="price" value="{{ old('price')}}">
            @error('price')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-3">
            <label for="type" class="mb-1"><span class="badge bg-danger">必須</span> 種別</label>
            <select class="form-select" id="type" name="type">
                <option value="">選択してください</option>
                @foreach ($types as $type)
                    <option value="{{ $type->code }}" @if($type->code == old('type')) selected @endif>{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="col-sm-6 mb-4">
            <label for="image" class="mb-1"><span class="badge bg-danger"></span> 作品画像(jpg, jpeg, png形式)</label>
            <input class="form-control" id="image" type="file" accept=".jpg, .jpeg, .png" name="image">
            @error('image')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <button class="btn btn-secondary mb-3" type="button"
            onclick="location.href='{{ route('admin.item.index') }}'">キャンセル</button>
        <button class="btn btn-primary mb-3" type="submit">登録</button>
    </form>
@endsection
