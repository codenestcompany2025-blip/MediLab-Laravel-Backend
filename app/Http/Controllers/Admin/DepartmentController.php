<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentRequest;
use App\Http\Requests\Admin\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

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

    public function store(StoreDepartmentRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('departments', 'public');

        Department::create($data);

        return redirect()->route('admin.departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($department->image && Storage::disk('public')->exists($department->image)) {
                Storage::disk('public')->delete($department->image);
            }
            $data['image'] = $request->file('image')->store('departments', 'public');
        }

        $department->update($data);

        return redirect()->route('admin.departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        if ($department->image && Storage::disk('public')->exists($department->image)) {
            Storage::disk('public')->delete($department->image);
        }

        $department->delete();

        return redirect()->route('admin.departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
