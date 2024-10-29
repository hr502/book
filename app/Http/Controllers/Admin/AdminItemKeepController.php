<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keep;

class AdminItemKeepController extends Controller
{
    public function index()
    {
        $keeps = Keep::orderBy('updated_at', 'desc')->paginate();
        return view('admin.item.keep.index', compact('keeps'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        DB::transaction(function() {

        });
    }
}
