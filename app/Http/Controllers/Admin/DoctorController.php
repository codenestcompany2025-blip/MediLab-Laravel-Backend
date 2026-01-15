<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDoctorRequest;
use App\Http\Requests\Admin\UpdateDoctorRequest;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function store(StoreDoctorRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->file('image')->store('doctors', 'public');

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = null;
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor created successfully.');
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
            if ($doctor->image && Storage::disk('public')->exists($doctor->image)) {
                Storage::disk('public')->delete($doctor->image);
            }
            $data['image'] = $request->file('image')->store('doctors', 'public');
        }

        // update password only if provided
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->image && Storage::disk('public')->exists($doctor->image)) {
            Storage::disk('public')->delete($doctor->image);
        }

        $doctor->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor deleted successfully.');
    }
}
