<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\ItemsImport;
use App\Exports\ItemsExport;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminItemController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Item::query()->with('itemJans');

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('author', 'LIKE', "%{$keyword}%");
        }

        $items = $query->paginate(15);

        return view('admin.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.item.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'series' => ['nullable', 'max:255'],
            'detail' => ['required', 'max:1000'],
            'published_on' => ['required', 'regex:/^[0-9]{4}\.(0[1-9]|1[0-2])$/'],
            'classification' => ['required',],
            'code' => ['required', ],
            'price' => ['required', 'regex:/^[0-9]+$/i'],
            'type' => ['required'],
            'image' => ['nullable', 'file', 'image', 'mimes:jpg, jpeg, png'],
        ]);


        $image = $request['image'];
        $file_name = 'noimage.jpg';

        if ($image) {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/item_img', $file_name);
        }

        DB::transaction(function() use ($request, $file_name) {
            $item = new Item();

            $item->create([
                'title' => $request['title'],
                'author' => $request['author'],
                'publisher' => $request['publisher'],
                'series' => $request['series'],
                'detail' => $request['detail'],
                'published_on' => $request['published_on'],
                'classification' => $request['classification'],
                'code' => $request['code'],
                'price' => $request['price'],
                'type_code' => $request['type'],
                'file_name' => $file_name,
                'file_path' => 'storage/item_img/' . $file_name
            ]);
        });

        return redirect()->route('admin.item.index')->with('flash_message', '登録が完了しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $type = Type::query()
            ->where('code', $item->type_code)
            ->first();

        return view('admin.item.show', [
            'item' => $item,
            'type' => $type,
        ]);
//        $item = Item::where('id', $id)->with('itemJans.status')->first();

//        return view('admin.item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);
        $types = Type::all();

        return view('admin.item.edit', compact('item', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'series' => ['nullable', 'max:255'],
            'detail' => ['required', 'max:1000'],
            'published_on' => ['required', 'regex:/^[0-9]{4}\.(0[1-9]|1[0-2])$/'],
            'classification' => ['required',],
            'code' => ['required', ],
            'price' => ['required', 'regex:/^[0-9]+$/i'],
            'type' => ['required'],
            'image' => ['nullable', 'file', 'image', 'mimes:jpg, jpeg, png'],
        ]);

        $item = Item::find($id);

        $image = $request['image'];
        $file_name = $item->file_name;

        if ($image) {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/item_img', $file_name);
        }

        DB::transaction(function() use($request, $item, $file_name) {
            $item->title = $request->title;
            $item->author = $request->author;
            $item->publisher = $request->publisher;
            $item->series = $request->series;
            $item->detail = $request->detail;
            $item->published_on = $request->published_on;
            $item->classification = $request->classification;
            $item->code = $request->code;
            $item->price = $request->price;
            $item->type_code = $request->type;
            $item->file_name = $file_name;
            $item->file_path = 'storage/item_img/' . $file_name;

            $item->save();
        });

        return redirect()->route('admin.item.show', $item->id)->with('flash_message', '更新が完了しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);

        DB::transaction(function() use ($item) {
            $item->delete();
        });

        return redirect()->route('admin.item.index')->with('flash_message', '削除が完了しました');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required','file',],
        ]);

        $file = $request->file('file');

        DB::transaction(function() use ($file)
        {
            Excel::import(new ItemsImport, $file);
        });

        return redirect()->route('admin.item.index');
    }

    public function export()
    {
        return Excel::download(new ItemsExport, 'Items.csv');
    }
}
