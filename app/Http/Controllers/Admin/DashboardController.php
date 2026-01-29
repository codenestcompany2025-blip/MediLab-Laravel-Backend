<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $appointmentsQuery = Appointment::query();

        $appointmentsCount = (clone $appointmentsQuery)->count();
        $pendingAppointmentsCount = (clone $appointmentsQuery)->where('status', 'pending')->count();
        $confirmedAppointmentsCount = (clone $appointmentsQuery)->where('status', 'confirmed')->count();
        $cancelledAppointmentsCount = (clone $appointmentsQuery)->where('status', 'cancelled')->count();

        // Latest 4 appointments for summary
        $latestAppointments = (clone $appointmentsQuery)
            ->latest('id')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'appointmentsCount',
            'pendingAppointmentsCount',
            'confirmedAppointmentsCount',
            'cancelledAppointmentsCount',
            'latestAppointments'
        ));
    }
}
