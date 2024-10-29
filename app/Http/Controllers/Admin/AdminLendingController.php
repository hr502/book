<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\User;
use App\Models\ItemJan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminLendingController extends Controller
{
    public function showLend()
    {
        return view('admin.lending.lend');
    }

    public function lend(Request $request)
    {
        $request->validate([
            'user_jan' => ['bail', 'required'],
            'item_jan.*' => ['bail', 'nullable', 'regex:/\A[0-9]+\z/i', 'digits:13'],
        ]);

        $user = User::where('jan', $request['user_jan'])->select('id')->first();

        $item_jans = array_values(array_filter($request['item_jan']));

        if (is_null($user)) {
            return back()->withErrors([
                'user_jan' => ['存在しないバーコードです']]
            );
        } elseif (empty($item_jans)) {
            return back()->withErrors([
                'item_jans' => ['貸出物は一つ以上入力が必要です']]
            );
        }

        $notExistItem = [];
        $notAvailableItem = [];

        foreach ($item_jans as $item_jan) {
            $item = ItemJan::where('jan', $item_jan)->first();

            // 貸出の履歴チェック
            if(is_Null($item)) {
                $notExistItem[] = $item_jan;
                continue;
            }

            // 作品のステータスチェック
            if($item->status_id !== 1) {
                $notAvailableItem[] = $item_jan;
                continue;
            }

            DB::transaction(function() use($user, $item_jan, $item) {
                $lending = new Lending();

                $lending->create([
                    'user_id' => $user->id,
                    'item_jan' => $item_jan,
                    'checkout_at' => Carbon::now(),
                    'due_at' => Carbon::now()->addWeeks(2)->setTime(23, 59, 59),
                ]);

                $item->status_id = 3;
                $item->save();
            });



        }

        return redirect()->route('admin.showLend')->with('flash_message', '貸出が完了しました');
    }

    public function showReturn()
    {
        return view('admin.lending.return');
    }

    public function return(Request $request)
    {
        $request->validate([
            'user_jan' => ['bail', 'required'],
            'item_jan.*' => ['bail', 'nullable', 'regex:/\A[0-9]+\z/i', 'digits:13'],
        ]);

        $user = User::where('jan', $request['user_jan'])->select('id')->first();

        $item_jans = array_values(array_filter($request['item_jan']));

        if (is_null($user)) {
            return back()->withErrors([
                'user_jan' => ['存在しないバーコードです']]
            );
        } elseif (empty($item_jans)) {
            return back()->withErrors([
                'item_jans' => ['返却物は一つ以上入力が必要です']]
            );
        }

        $notExistItem = [];
        $notAvailableItem = [];

        foreach ($item_jans as $item_jan) {
            // 返却物のステータスチェック
            $item = ItemJan::where('jan', $item_jan)->first();

            if($item->status_id !== 3) {
                $notAvailableItem[] = $item_jan;
                continue;
            }

            // 貸出の履歴チェック
            $lending = Lending::where('user_id', $user->id)
                ->where('item_jan', $item_jan)
                ->whereNull('return_at')
                ->first();

            if(is_Null($lending)) {
                $notExistItem[] = $item_jan;
                continue;
            }

            DB::transaction(function() use($lending, $item) {
                $lending->return_at = Carbon::now();
                $lending->save();

                $item->status_id = 1;
                $item->save();
            });
        }

        return redirect()->route('admin.showReturn')->with('flash_message', '返却が完了しました');
    }
}
