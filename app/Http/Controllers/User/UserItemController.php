<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserItemController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Item::query()->with('itemJans');

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('author', 'LIKE', "%{$keyword}%");
        }

        $items = $query->paginate(15);

        return view('user.item.index', compact('items'));
    }

    public function show($id)
    {
        $user_id = Auth::id();

        $item = Item::find($id);

        if(empty($item)) {
            return abort(404);
        }

        $is_reserve = Reservation::where('user_id', $user_id)
                    ->where('item_id', $id)
                    ->where('status', 1)
                    ->whereNull('canceled_at')
                    ->exists();

        return view('user.item.show', [
            'item' => $item,
            'is_reserve' => $is_reserve
        ]);
    }

    public function reserve($id)
    {
        $user_id = Auth::id();

        DB::transaction(function () use ($user_id, $id) {
            $reserve = new Reservation();

            $reserve->create([
                "user_id" => $user_id,
                "item_id" => $id,
                "reservation_at" => Carbon::now(),
                "status" => 1
            ]);
        });

        return redirect()->route('user.item.show', ['item' => $id]);
    }

    public function cancel($id)
    {
        $user_id = Auth::id();

        $reserve = Reservation::where('item_id', $id)
            ->where('user_id', $user_id)
            ->where('status', 1)
            ->whereNull('canceled_at')
            ->first();

        DB::transaction(function () use ($reserve) {
            $reserve->status = 2;
            $reserve->canceled_at = Carbon::now();

            $reserve->save();
        });

        return redirect()->route('user.item.show', ['item' => $id]);
    }
}
