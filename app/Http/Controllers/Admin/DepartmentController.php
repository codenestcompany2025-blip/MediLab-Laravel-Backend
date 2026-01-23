<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentRequest;
use App\Http\Requests\Admin\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
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

    public function store(StoreDepartmentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageToPublicStorage($request->file('image'), 'departments');
        }

        Department::create($data);

        return redirect()->route('admin.departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deletePublicStorageFile($department->image);
            $data['image'] = $this->uploadImageToPublicStorage($request->file('image'), 'departments');
        }

        $department->update($data);

        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $this->deletePublicStorageFile($department->image);
        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully.');
    }
}
