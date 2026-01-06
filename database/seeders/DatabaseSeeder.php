<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );

        // Departments
        $departments = collect([
            ['name' => 'Cardiology', 'description' => 'Heart & vascular care'],
            ['name' => 'Neurology', 'description' => 'Brain & nervous system'],
            ['name' => 'Pediatrics', 'description' => 'Children healthcare'],
        ])->map(fn ($d) => Department::create($d));

        // Services
        collect([
            ['title' => 'Emergency Care', 'description' => '24/7 emergency service', 'icon' => 'fas fa-ambulance'],
            ['title' => 'Lab Tests', 'description' => 'Accurate medical lab tests', 'icon' => 'fas fa-vials'],
            ['title' => 'Dental Care', 'description' => 'Dental treatment services', 'icon' => 'fas fa-tooth'],
        ])->each(fn ($s) => Service::create($s));

        // Doctors
        $doctors = collect([
            [
                'name' => 'Dr. Sama',
                'specialty' => 'Cardiologist',
                'email' => 'dr.sama@example.com',
                'password' => Hash::make('12345678'),
                'bio' => 'Experienced cardiologist with 10+ years of practice.',
                'department_id' => $departments[0]->id,
                'image' => null,
            ],
            [
                'name' => 'Dr. Ahmad',
                'specialty' => 'Neurologist',
                'email' => 'dr.ahmad@example.com',
                'password' => Hash::make('12345678'),
                'bio' => 'Specialist in neurology with strong clinical background.',
                'department_id' => $departments[1]->id,
                'image' => null,
            ],
        ])->map(fn ($doc) => Doctor::create($doc));

        // FAQs 
        collect([
            ['question' => 'How to book an appointment?', 'answer' => 'Go to appointments section and fill the form.', 'display_order' => 1],
            ['question' => 'Do you accept insurance?', 'answer' => 'Yes, we accept most insurance plans.', 'display_order' => 2],
            ['question' => 'What are working hours?', 'answer' => 'We are open from 8 AM to 8 PM.', 'display_order' => 3],
        ])->each(fn ($f) => Faq::create($f));

        // Testimonials
        collect([
            ['name' => 'Sara', 'job_title' => 'Designer', 'comment' => 'Great service and friendly staff!', 'image' => null],
            ['name' => 'Omar', 'job_title' => 'Engineer', 'comment' => 'Clean clinic and professional doctors.', 'image' => null],
        ])->each(fn ($t) => Testimonial::create($t));

        // Galleries
        collect([
            ['caption' => 'Reception Area', 'image' => null],
            ['caption' => 'Clinic Room', 'image' => null],
        ])->each(fn ($g) => Gallery::create($g));

        // Appointments
        collect([
            [
                'name' => 'Patient One',
                'email' => 'patient1@example.com',
                'phone' => '0590000001',
                'appointment_at' => now()->addDays(1),
                'department_id' => $departments[0]->id,
                'doctor_id' => $doctors[0]->id,
                'message' => 'Need consultation.',
                'status' => 'pending',
            ],
            [
                'name' => 'Patient Two',
                'email' => 'patient2@example.com',
                'phone' => '0590000002',
                'appointment_at' => now()->addDays(2),
                'department_id' => $departments[1]->id,
                'doctor_id' => $doctors[1]->id,
                'message' => 'Follow-up visit.',
                'status' => 'confirmed',
            ],
        ])->each(fn ($a) => Appointment::create($a));
    }
}
