<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
            'image'   => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'caption' => $data['caption'] ?? null,
            'path' => $path,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery image added.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
            'image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $update = [
            'caption' => $data['caption'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
                Storage::disk('public')->delete($gallery->path);
            }
            $update['path'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($update);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
            Storage::disk('public')->delete($gallery->path);
        }
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery deleted.');
    }
}
