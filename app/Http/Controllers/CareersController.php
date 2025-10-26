<?php

namespace App\Http\Controllers;

use App\Models\Career;

class CareersController extends Controller
{
    public function index()
    {
        $items = Career::published()->latest('published_at')->paginate(9);
        return view('careers.index', compact('items'));
    }

    public function show($slug)
    {
        $item = Career::published()->where('slug', $slug)->firstOrFail();
        return view('careers.show', compact('item'));
    }
}

