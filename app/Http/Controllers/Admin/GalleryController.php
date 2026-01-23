<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;

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

    private function uploadImageToPublicStorage($file, string $folder): string
    {
        $dir = public_path("storage/{$folder}");
        File::ensureDirectoryExists($dir);

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return "{$folder}/{$filename}";
    }

    private function deletePublicStorageFile(?string $relativePath): void
    {
        if (!$relativePath) return;

        $fullPath = public_path('storage/' . $relativePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }

    public function store(StoreGalleryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('path')) {
            $data['path'] = $this->uploadImageToPublicStorage($request->file('path'), 'galleries');
        }

        Gallery::create($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery image added successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();

        if ($request->hasFile('path')) {
            $this->deletePublicStorageFile($gallery->path);
            $data['path'] = $this->uploadImageToPublicStorage($request->file('path'), 'galleries');
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $this->deletePublicStorageFile($gallery->path);
        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery image deleted successfully.');
    }
}
