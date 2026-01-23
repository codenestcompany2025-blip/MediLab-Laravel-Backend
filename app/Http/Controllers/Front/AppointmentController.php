<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255'],
            'phone'          => ['required', 'string', 'max:50'],
            'appointment_at' => ['required', 'date'],
            'department_id'  => ['nullable', 'exists:departments,id'],
            'doctor_id'      => ['nullable', 'exists:doctors,id'],
            'message'        => ['nullable', 'string', 'max:2000'],
        ]);

        Appointment::create([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'phone'          => $validated['phone'],
            'appointment_at' => $validated['appointment_at'],
            'department_id'  => $validated['department_id'] ?? null,
            'doctor_id'      => $validated['doctor_id'] ?? null,
            'message'        => $validated['message'] ?? null,
            'status'         => 'pending',
        ]);

        return redirect()
            ->to(route('front.home') . '#appointment')
            ->with('success', 'Your appointment request has been successfully submitted, we will contact you soon.');
    }
}
