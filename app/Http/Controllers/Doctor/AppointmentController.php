<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $doctorId = auth('doctor')->id();

        $appointments = Appointment::with(['department', 'doctor'])
            ->where('doctor_id', $doctorId)
            ->orderByDesc('id')
            ->paginate(10);

        return view('doctor.appointments.index', compact('appointments'));
    }

    public function edit(Appointment $appointment)
    {
        $this->authorizeDoctor($appointment);

        return view('doctor.appointments.edit', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorizeDoctor($appointment);

        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ]);

        $appointment->update($data);

        return redirect()
            ->route('doctor.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    private function authorizeDoctor(Appointment $appointment): void
    {
        if ($appointment->doctor_id !== auth('doctor')->id()) {
            abort(403);
        }
    }
}
