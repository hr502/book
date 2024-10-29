<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lending;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->paginate();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jan' => ['bail', 'required', 'digits:8', 'regex:/\A2[2-9]{1}[0-9]+\z/i', 'unique:users'],
            'name' => ['bail', 'required', 'max:40'],
            'name_kana' => ['bail', 'required', 'max:80'],
            'birth_date' => ['bail', 'required', 'date'],
            'phone_number' => ['bail', 'required', 'max:15', 'regex:/^0[0-9]{1,4}-[0-9]{1,4}-[0-9]{3,4}\z/'],
            'email' => ['bail', 'nullable', 'email:filter'],
            'password' => ['bail', 'nullable', 'confirmed', 'between:8,16', 'regex:/^[0-9a-zA-Z]+$/i'],
            'password_confirmation' => ['bail', 'required_with:password'],
        ]);

        DB::Transaction(function() use ($request) {
            $user = new User();
            $user->create([
                'jan' => $request['jan'],
                'name' => $request['name'],
                'name_kana' => $request['name_kana'],
                'birth_date' => $request['birth_date'],
                'phone_number' => $request['phone_number'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
        });

        return redirect()->route('admin.user.index')->with('flash_message', '登録が完了しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $lendings = Lending::query()
            ->toBase()
            ->select('lendings.user_id as user_id',
                'lendings.checkout_at as checkout_at',
                'lendings.return_at as return_at',
                'lendings.due_at as due_at',
                'lendings.updated_at as updated_at',
                'lendings.item_jan as jan',
                'items.title as title',
                'items.author as author')
            ->leftJoin('item_jans','lendings.item_jan', '=', 'item_jans.jan')
            ->leftJoin('items', 'item_jans.item_id', '=', 'items.id')
            ->where('user_id', $id)
            ->orderBy('updated_at', 'desc')
            ->paginate();

        return view('admin.user.show', compact('user', 'lendings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $request->validate([
            'jan' => ['bail', 'required', 'digits:8', 'regex:/\A2[2-9]{1}[0-9]+\z/i', Rule::unique('users')->ignore($user)],
            'name' => ['bail', 'required', 'max:40'],
            'name_kana' => ['bail', 'required', 'max:80', 'regex:/\A[ァ-ヴー]+\z/u'],
            'birth_date' => ['bail', 'required', 'date'],
            'phone_number' => ['bail', 'required', 'max:15', 'regex:/\A0[0-9]{1,4}-[0-9]{1,4}-[0-9]{3,4}\z/'],
            'email' => ['bail', 'nullable', 'email:filter'],
            'password' => ['bail', 'nullable', 'confirmed', 'between:8,16', 'regex:/\A[0-9a-zA-Z]+\z/'],
            'password_confirmation' => ['bail', 'required_with:password'],
        ]);

        DB::transaction(function() use ($user, $request) {
            $user->jan = $request['jan'];
            $user->name = $request['name'];
            $user->name_kana = $request['name_kana'];
            $user->birth_date = $request['birth_date'];
            $user->phone_number = $request['phone_number'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);

            $user->save();
        });

        return redirect()->route('admin.user.show', $id)->with('flash_message', '更新が完了しました');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('flash_message', '削除が完了しました');
    }
}
