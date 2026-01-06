<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['department','doctor'])
            ->latest()
            ->paginate(10);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $doctors = Doctor::orderBy('name')->get();

        return view('admin.appointments.create', compact('departments', 'doctors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:50',
            'appointment_at' => 'required|date',
            'department_id'  => 'required|exists:departments,id',
            'doctor_id'      => 'required|exists:doctors,id',
            'message'        => 'nullable|string',
            'status'         => 'required|in:pending,confirmed,cancelled',
        ]);

        Appointment::create($data);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $departments = Department::orderBy('name')->get();
        $doctors = Doctor::orderBy('name')->get();

        return view('admin.appointments.edit', compact('appointment','departments','doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:50',
            'appointment_at' => 'required|date',
            'department_id'  => 'required|exists:departments,id',
            'doctor_id'      => 'required|exists:doctors,id',
            'message'        => 'nullable|string',
            'status'         => 'required|in:pending,confirmed,cancelled',
        ]);

        $appointment->update($data);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $appointment->update($data);

        return back()->with('success', 'Status updated successfully.');
    }
}
