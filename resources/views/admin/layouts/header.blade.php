@if(Auth::guard('admin')->check())
    <div class="container my-1">
        <a class="d-inline-block mr-4 link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('admin.index')}}">トップ</a>
        <a class="d-inline-block link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('admin.logout')}}">ログアウト</a>
    </div>
@endif
