<?php

namespace App\Http\Controllers;

use App\Models\Press;

class PressController extends Controller
{
    public function index()
    {
        $items = Press::published()->latest('published_at')->paginate(9);
        return view('press.index', compact('items'));
    }

    public function show($slug)
    {
        $item = Press::published()->where('slug', $slug)->firstOrFail();
        return view('press.show', compact('item'));
    }
}

