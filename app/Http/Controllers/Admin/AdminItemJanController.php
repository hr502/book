<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemJan;
use Illuminate\Support\Facades\DB;

class AdminItemJanController extends Controller
{
    public function create(string $item_id)
    {
        $item = Item::find($item_id);
        return view('admin.item.jan.create', compact('item'));
    }

    public function store(Request $request, string $item_id)
    {
        $request->validate([
            'jan' => ['required', 'regex:/^2[0-9]+$/i', 'digits:13', 'unique:item_jans'],
            'read-onry' => ['nullable', 'boolean']
        ]);

        $status = 1;

        if(isset($request['read-only'])) {
            $status = 9;
        }

        DB::transaction(function() use($request, $item_id, $status) {
            $jan = new itemJan();

            $jan->create([
                'item_id' => $item_id,
                'jan' => $request->jan,
                'status_id' => $status,
            ]);
        });

        return redirect()->route('admin.item.show', $item_id)->with('flash_message', '登録が完了しました');
    }

    public function show(string $item, $jan)
    {
        abort(404);
    }

    public function edit(string $item_id, $jan_id)
    {
        $item = Item::find($item_id);
        $jan = ItemJan::find($jan_id);
        return view('admin.item.jan.edit', compact('item', 'jan'));
    }

    public function update(Request $request, string $item_id, $jan_id)
    {
        $request->validate([
            'jan' => ['required', 'regex:/^2[0-9]+$/i', 'digits:13', 'unique:item_jans,jan,' . $jan_id . ',id']
        ]);

        $jan = ItemJan::find($jan_id);

        DB::transaction(function() use($request, $jan) {
            $jan->jan = $request->jan;
            $jan->save();
        });


        return redirect()->route('admin.item.show', $item_id);
    }

    public function destroy(string $item_id, $jan_id)
    {
        $jan = ItemJan::find($jan_id);

        DB::transaction(function() use($jan) {
            $jan->delete();
        });

        return redirect()->route('admin.item.show', $item_id)->with('flash_message', '削除が完了しました');
    }
}
