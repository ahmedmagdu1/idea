<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Press;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PressController extends Controller
{
    public function index()
    {
        $items = Press::latest()->paginate(20);
        return view('admin.press.index', compact('items'));
    }

    public function create()
    {
        return view('admin.press.form', ['item' => new Press()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:presses,slug',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);
        if (empty($data['slug'])) { $data['slug'] = Str::slug($data['title']); }
        $data['is_published'] = (bool)($data['is_published'] ?? false);
        if ($request->hasFile('image')) {
            $dir = public_path('uploads/press');
            if (! File::exists($dir)) { File::makeDirectory($dir, 0755, true); }
            $filename = time().'_'.Str::random(8).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $filename);
            $data['image'] = 'uploads/press/'.$filename;
        }
        Press::create($data);
        return redirect()->route('admin.press.index')->with('status', 'Press post created');
    }

    public function edit(Press $press)
    {
        return view('admin.press.form', ['item' => $press]);
    }

    public function update(Request $request, Press $press)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:presses,slug,' . $press->id,
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);
        if (empty($data['slug'])) { $data['slug'] = Str::slug($data['title']); }
        $data['is_published'] = (bool)($data['is_published'] ?? false);
        if ($request->hasFile('image')) {
            $dir = public_path('uploads/press');
            if (! File::exists($dir)) { File::makeDirectory($dir, 0755, true); }
            $filename = time().'_'.Str::random(8).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $filename);
            $data['image'] = 'uploads/press/'.$filename;
        }
        $press->update($data);
        return redirect()->route('admin.press.index')->with('status', 'Press post updated');
    }

    public function destroy(Press $press)
    {
        $press->delete();
        return redirect()->route('admin.press.index')->with('status', 'Press post deleted');
    }
}
