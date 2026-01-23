<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppointmentRequest;
use App\Http\Requests\Admin\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['department', 'doctor'])
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

    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->validated();
        Appointment::create($data);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $departments = Department::orderBy('name')->get();
        $doctors = Doctor::orderBy('name')->get();

        return view('admin.appointments.edit', compact('appointment', 'departments', 'doctors'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $data = $request->validated();
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
}
