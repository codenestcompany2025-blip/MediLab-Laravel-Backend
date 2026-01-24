<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     */
    public function index()
{
    $appointments = \App\Models\Appointment::with(['department', 'doctor'])
        ->orderBy('id', 'asc') 
        ->paginate(10);

    return view('admin.appointments.index', compact('appointments'));
}

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        $departments = Department::all();
        $doctors = Doctor::all();

        return view('admin.appointments.create', compact('departments', 'doctors'));
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'appointment_at' => ['required', 'date'],
            'department_id' => ['required', 'exists:departments,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'status' => ['required', 'in:pending,confirmed,cancelled'],
            'message' => ['nullable', 'string'],
        ]);

        Appointment::create($validated);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    /**
     * Show the form for editing the specified appointment.
     */
    public function edit(Appointment $appointment)
    {
        $departments = Department::all();
        $doctors = Doctor::all();

        return view('admin.appointments.edit', compact(
            'appointment',
            'departments',
            'doctors'
        ));
    }

    /**
     * Update the specified appointment in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'appointment_at' => ['required', 'date'],
            'department_id' => ['required', 'exists:departments,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'status' => ['required', 'in:pending,confirmed,cancelled'],
            'message' => ['nullable', 'string'],
        ]);

        $appointment->update($validated);

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified appointment from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
