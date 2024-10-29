@extends('admin.layouts.parents')
@section('title', 'ダッシュボード')
@section('content')
<div class="my-3 form-group">
    <label class="mb-1" for="lending">貸出・返却処理</label>
    <div id="lending">
        <button class="btn btn-primary" onclick="location.href='{{ route('admin.lend')}}'">貸出処理</button>
        <button class="btn btn-primary" onclick="location.href='{{ route('admin.return')}}'">返却処理</button>
    </div>
</div>
<div class="mb-3 form-group">
    <label class="mb-1" for="management">管理機能</label>
    <div id="management">
        <button class="btn btn-primary" onclick="location.href='{{ route('admin.member.index')}}'">従業員管理</button>
        <button class="btn btn-primary" onclick="location.href='{{ route('admin.item.index')}}'">作品管理</button>
        <button class="btn btn-primary" onclick="location.href='{{ route('admin.user.index')}}'">利用者管理</button>
    </div>
</div>
@endsection
