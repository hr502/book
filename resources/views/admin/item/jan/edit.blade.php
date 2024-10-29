@extends('admin.layouts.parents')
@section('title', 'JAN編集')
@section('content')
<p class=text-danger>！バーコードの更新は必ず物品を確保してから行なってください</p>
<form method="post" action="{{ route('admin.item.jan.update', [$item->id, $jan->id])}}">
    @csrf
    @method('PATCH')
    <p class="headline">jan</p>
    <input class="input" type="text" name="jan" value="{{old('jan', $jan->jan)}}">
    @error('jan')
        <li class="err">{{ $message }}</li>
    @enderror
    <div class="btn-container">
        <button class="btn submit" type="submit">更新</button>
    </div
</form>
@endsection
