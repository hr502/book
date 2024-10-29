<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('guest');
//        $this->middleware('guest:admin');
//    }

    public function index()
    {
        $admins = Admin::with('role')->get();
        return view('admin.member.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.member.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['bail', 'required'],
            'jan' => ['bail', 'required', 'regex:/\A2[0-1]{1}[0-9]+\z/i', 'digits:8', 'unique:admins'],
            'password' => ['bail', 'required', 'confirmed', 'between:8,16'],
            'password_confirmation' => ['bail', 'required'],
            'role' => ['bail', 'required'],
        ]);

        DB::transaction(function () use ($request) {
            $admin = new Admin();

            $admin->create([
                'name' => $request['name'],
                'jan' => $request['jan'],
                'password' => Hash::make($request['password']),
                'role_id' => $request['role'],
            ]);
        });

        return redirect()->route('admin.member.index')->with('flash_message', '登録が完了しました');
    }

    public function show() {
        return abort(404);
    }

    public function edit(string $id)
    {
        $roles = Role::all();
        $admin = Admin::with('role')->find($id);

        return view('admin.member.edit', compact('roles', 'admin'));
    }

    public function update(Request $request, string $id)
    {
        $admin = Admin::with('role')->find($id);

        $request->validate([
            'name' => ['bail', 'required'],
            'jan' => ['bail', 'required', 'regex:/\A2[0-1]{1}[0-9]+\z/i', 'digits:8', Rule::unique('admins')->ignore($admin)],
            'password' => ['bail', 'nullable', 'confirmed', 'between:8,16'],
            'role' => ['bail', 'required'],
        ]);

        $password = $admin->password;
        $newPassword = $request->password;

        if ($newPassword) {
            $password = Hash::make($request['password']);
        }

        DB::transaction(function () use ($request, $admin, $password) {
            $admin->name = $request->name;
            $admin->jan = $request->jan;
            $admin->password = $password;
            $admin->role_id = $request->role;

            $admin->save();
        });

        return redirect()->route('admin.member.index')->with('flash_message', '更新が完了しました');
    }

    public function destroy(string $id)
    {
        $admin = Admin::find($id);

        DB::transaction(function() use ($admin) {
            $admin->delete();
        });

        return redirect()->route('admin.member.index')->with('flash_message', '削除が完了しました');
    }
}
