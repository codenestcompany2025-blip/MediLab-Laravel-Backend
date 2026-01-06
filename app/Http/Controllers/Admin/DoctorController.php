<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'specialty'     => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],

            'bio'           => ['nullable', 'string'],
            'email'         => ['nullable', 'email', 'max:255', 'unique:doctors,email'],
            'password'      => ['nullable', 'string', 'min:6'],

            'facebook'      => ['nullable', 'string', 'max:255'],
            'twitter'       => ['nullable', 'string', 'max:255'],
            'instagram'     => ['nullable', 'string', 'max:255'],
            'linkedin'      => ['nullable', 'string', 'max:255'],

            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('doctors', 'public');
        }

        if (empty($data['password'])) unset($data['password']);

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created.');
    }

    public function edit(Doctor $doctor)
    {
        $departments = Department::orderBy('name')->get();
        return view('admin.doctors.edit', compact('doctor', 'departments'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'specialty'     => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],

            'bio'           => ['nullable', 'string'],
            'email'         => ['nullable', 'email', 'max:255', 'unique:doctors,email,' . $doctor->id],
            'password'      => ['nullable', 'string', 'min:6'],

            'facebook'      => ['nullable', 'string', 'max:255'],
            'twitter'       => ['nullable', 'string', 'max:255'],
            'instagram'     => ['nullable', 'string', 'max:255'],
            'linkedin'      => ['nullable', 'string', 'max:255'],

            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($doctor->image && Storage::disk('public')->exists($doctor->image)) {
                Storage::disk('public')->delete($doctor->image);
            }
            $data['image'] = $request->file('image')->store('doctors', 'public');
        }

        if (empty($data['password'])) unset($data['password']);
        if (!array_key_exists('email', $data) || empty($data['email'])) unset($data['email']);

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated.');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->image && Storage::disk('public')->exists($doctor->image)) {
            Storage::disk('public')->delete($doctor->image);
        }
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted.');
    }
}
