<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = auth('doctor')->user();

        $appointmentsQuery = Appointment::where('doctor_id', $doctor->id);

        $appointmentsCount = (clone $appointmentsQuery)->count();
        $pendingAppointmentsCount = (clone $appointmentsQuery)->where('status', 'pending')->count();
        $confirmedAppointmentsCount = (clone $appointmentsQuery)->where('status', 'confirmed')->count();
        $cancelledAppointmentsCount = (clone $appointmentsQuery)->where('status', 'cancelled')->count();

        //  Engineer asked: dashboard summary only last 4
        $latestAppointments = (clone $appointmentsQuery)
            ->latest('id')
            ->take(4)
            ->get();

        return view('doctor.dashboard', compact(
            'appointmentsCount',
            'pendingAppointmentsCount',
            'confirmedAppointmentsCount',
            'cancelledAppointmentsCount',
            'latestAppointments'
        ));
    }
}
