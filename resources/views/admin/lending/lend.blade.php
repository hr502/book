@extends('admin.layouts.parents')
@section('title', '貸出処理')
@section('content')
    @if (session('flash_message'))
        <div class="alert alert-success my-3">
            {{ session('flash_message') }}
        </div>
    @endif
    <h3 class="my-3">貸出処理　　<span><button class="btn btn-secondary btn-sm" onclick="location.href='{{ route('admin.return') }}'">返却処理に移動</button></span></h3>
    <form class="text-right" method="post" action="{{ route('admin.lend') }}">
        @csrf
        <div class="mb-3 col-sm-6">
            <label class="mb-1" for="user_jan">借りる人</label>
            <input class="form-control" type="text" name="user_jan">
            @error('user_jan')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
        </div>
        <div class="mb-4">
            <label for="item_jan" class="mb-1">貸出物</label>
            <div class="col-sm-6">
                <div class="input-group input-group-sm mb-2">
                    <input class="form-control" type="text" id="item_jan1" name="item_jan[]">
                    <span class="input-group-btn">
                        <input class="btn btn-secondary" type="button" value="クリア" onclick="clearText('item_jan1')" />
                    </span>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <input class="form-control" type="text" id="item_jan2" name="item_jan[]">
                    <span class="input-group-btn">
                        <input class="btn btn-secondary" type="button" value="クリア" onclick="clearText('item_jan2')" />
                    </span>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <input class="form-control" type="text" id="item_jan3" name="item_jan[]">
                    <span class="input-group-btn">
                        <input class="btn btn-secondary" type="button" value="クリア" onclick="clearText('item_jan3')" />
                    </span>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <input class="form-control" type="text" id="item_jan4" name="item_jan[]">
                    <span class="input-group-btn">
                        <input class="btn btn-secondary" type="button" value="クリア" onclick="clearText('item_jan4')" />
                    </span>
                </div>
                <div class="input-group input-group-sm mb-2">
                    <input class="form-control" type="text" id="item_jan5" name="item_jan[]">
                    <span class="input-group-btn">
                        <input class="btn btn-secondary" type="button" value="クリア" onclick="clearText('item_jan5')" />
                    </span>
                </div>
            </div>
            @error('item_jans')
                <li class="list-unstyled text-danger">{{ $message }}</li>
            @enderror
            @foreach($errors->get('item_jan.*') as $messages)
                @foreach ($messages as $message)
                    <li class="list-unstyled text-danger">{{ $message }}</li>
                @endforeach
            @endforeach
        </div>
        <div>
            <button class="btn btn-secondary" type="button" onclick="location.href='{{ route('admin.index')}}'">戻る</button>
            <button class="btn btn-primary" type="submit">登録</button>
        </div>
    </form>

@endsection

@section('script')
    <script>
        function clearText($id) {
	        var textForm = document.getElementById($id);
            textForm.value = '';
        }
    </script>
@endsection
