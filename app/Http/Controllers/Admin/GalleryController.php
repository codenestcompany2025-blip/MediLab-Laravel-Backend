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
            'caption' => ['nullable','string','max:255'],
            'path' => ['required','image','mimes:jpg,jpeg,png,webp','max:4096'],
        ]);

        $data['path'] = $request->file('path')->store('gallery', 'public');

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success','Image uploaded successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'caption' => ['nullable','string','max:255'],
            'path' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
        ]);

        if ($request->hasFile('path')) {
            if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
                Storage::disk('public')->delete($gallery->path);
            }
            $data['path'] = $request->file('path')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success','Gallery updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
            Storage::disk('public')->delete($gallery->path);
        }
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success','Gallery deleted successfully.');
    }
}
