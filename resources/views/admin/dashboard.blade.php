@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <!-- ================= Summary Cards ================= -->
    <div class="row mb-4">

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Appointments
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $appointmentsCount ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Pending
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $pendingAppointmentsCount ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Confirmed
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $confirmedAppointmentsCount ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Cancelled
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $cancelledAppointmentsCount ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= Charts ================= -->
    <div class="row mb-4">

        <!-- Pie Chart -->
        <div class="col-lg-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Appointments by Status
                    </h6>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height:280px;">
                    <canvas id="appointmentsStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-lg-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Appointments Overview
                    </h6>
                </div>
                <div class="card-body" style="height:280px;">
                    <canvas id="appointmentsBarChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= Latest 4 Reservations Summary ================= -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                Latest 4 Reservations (Summary)
            </h6>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline-primary">
                View Full List
            </a>
        </div>

        <div class="card-body">
            @if(isset($latestAppointments) && $latestAppointments->count())
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Phone</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->phone }}</td>
                                    <td>
                                        {{ $appointment->appointment_at
                                            ? \Carbon\Carbon::parse($appointment->appointment_at)->format('Y-m-d H:i')
                                            : '-' }}
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ 
                                            $appointment->status === 'pending' ? 'warning' :
                                            ($appointment->status === 'confirmed' ? 'success' : 'danger')
                                        }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <small class="text-muted d-block mt-2">
                    Dashboard shows only the latest 4 reservations as a summary.
                </small>
            @else
                <p class="text-muted mb-0">No reservations found.</p>
            @endif
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const pendingCount   = {{ $pendingAppointmentsCount ?? 0 }};
    const confirmedCount = {{ $confirmedAppointmentsCount ?? 0 }};
    const cancelledCount = {{ $cancelledAppointmentsCount ?? 0 }};

    // Pie chart
    new Chart(document.getElementById('appointmentsStatusChart'), {
        type: 'pie',
        data: {
            labels: ['Pending', 'Confirmed', 'Cancelled'],
            datasets: [{
                data: [pendingCount, confirmedCount, cancelledCount],
                backgroundColor: ['#f6c23e', '#1cc88a', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 14,
                        font: { size: 12 }
                    }
                }
            }
        }
    });

    // Bar chart
    new Chart(document.getElementById('appointmentsBarChart'), {
        type: 'bar',
        data: {
            labels: ['Pending', 'Confirmed', 'Cancelled'],
            datasets: [{
                label: 'Appointments',
                data: [pendingCount, confirmedCount, cancelledCount],
                backgroundColor: '#4e73df',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endsection
