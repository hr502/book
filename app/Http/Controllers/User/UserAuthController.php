<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function show()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('user.index');
        }

        return back()->withErrors([
            'auth'=> ['認証に失敗しました']]
        );
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('user.show');
    }
}
