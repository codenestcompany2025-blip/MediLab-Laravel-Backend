<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(StoreGalleryRequest $request)
    {
        $data = $request->validated();

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'caption' => $data['caption'] ?? null,
            'path'    => $path,
        ]);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery image added successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
                Storage::disk('public')->delete($gallery->path);
            }
            $gallery->path = $request->file('image')->store('galleries', 'public');
        }

        $gallery->caption = $data['caption'] ?? null;
        $gallery->save();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->path && Storage::disk('public')->exists($gallery->path)) {
            Storage::disk('public')->delete($gallery->path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery deleted successfully.');
    }
}
