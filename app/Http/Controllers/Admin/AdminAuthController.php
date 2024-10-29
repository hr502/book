<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function show()
    {
        if(Auth::guard('admin')->check()) {
            return back();
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard('admin')->attempt(['jan' => $request->jan, 'password' => $request->password])) {
            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'auth'=> ['認証に失敗しました']]
        );
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
