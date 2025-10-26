<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CareerController extends Controller
{
    public function index()
    {
        $items = Career::latest()->paginate(20);
        return view('admin.careers.index', compact('items'));
    }

    public function create()
    {
        return view('admin.careers.form', ['item' => new Career()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:careers,slug',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:120',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);
        if (empty($data['slug'])) { $data['slug'] = Str::slug($data['title']); }
        $data['is_published'] = (bool)($data['is_published'] ?? false);
        if ($request->hasFile('image')) {
            $dir = public_path('uploads/careers');
            if (! File::exists($dir)) { File::makeDirectory($dir, 0755, true); }
            $filename = time().'_'.Str::random(8).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $filename);
            $data['image'] = 'uploads/careers/'.$filename;
        }
        Career::create($data);
        return redirect()->route('admin.careers.index')->with('status', 'Career created');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.form', ['item' => $career]);
    }

    public function update(Request $request, Career $career)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:careers,slug,' . $career->id,
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:120',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);
        if (empty($data['slug'])) { $data['slug'] = Str::slug($data['title']); }
        $data['is_published'] = (bool)($data['is_published'] ?? false);
        if ($request->hasFile('image')) {
            $dir = public_path('uploads/careers');
            if (! File::exists($dir)) { File::makeDirectory($dir, 0755, true); }
            $filename = time().'_'.Str::random(8).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dir, $filename);
            $data['image'] = 'uploads/careers/'.$filename;
        }
        $career->update($data);
        return redirect()->route('admin.careers.index')->with('status', 'Career updated');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')->with('status', 'Career deleted');
    }
}
