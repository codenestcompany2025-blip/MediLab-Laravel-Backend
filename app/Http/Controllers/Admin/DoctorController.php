<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDoctorRequest;
use App\Http\Requests\Admin\UpdateDoctorRequest;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('department')->latest()->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.doctors.create', compact('departments'));
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

    public function store(StoreDoctorRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageToPublicStorage($request->file('image'), 'doctors');
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function edit(Doctor $doctor)
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.doctors.edit', compact('doctor', 'departments'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deletePublicStorageFile($doctor->image);
            $data['image'] = $this->uploadImageToPublicStorage($request->file('image'), 'doctors');
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        $this->deletePublicStorageFile($doctor->image);
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
