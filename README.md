# MediLab – Laravel Admin & Doctor Dashboards + One-Page Frontend

MediLab is a full-stack medical website built with **Laravel**, featuring:
- a modern **Admin Dashboard**
- a dedicated **Doctor Dashboard** (separate authentication)
- a public **One-Page Frontend Website** aligned with the original MediLab Bootstrap template.

---

## Frontend Website
The frontend is implemented as a **single-page website**, matching the MediLab template structure and behavior.

### Implemented Sections
- Hero
- About
- Services
- Departments
- Doctors
- Appointment
- Gallery
- FAQ
- Testimonials
- Contact

### Navigation Bar
- All navbar links correctly scroll to their sections
- **Contact** link included in the navbar
- **“Make an Appointment”** call-to-action button available
- Responsive behavior for desktop and mobile

---

## Appointment Feature (Frontend)
- Appointment form submits via POST
- Data is stored in the database
- Success message displayed after submission
- Redirects back to the Appointment section

---

## Contact Feature (Frontend)
- Contact form submits via POST
- Messages are stored in the database
- Messages are sent via email (Mail configured in `.env`)
- Success message displayed
- Redirects back to the Contact section

---

## Admin Panel
- Separate admin authentication (custom guard)
- Secure admin login system
- Dashboard with appointment analytics:
  - **Pending / Confirmed / Cancelled** charts
- Full CRUD management for:
  - Departments
  - Services
  - Doctors
  - FAQs
  - Testimonials
  - Gallery
  - Appointments
- Image upload and preview support
- Form validation and pagination

---

## Doctor Panel
- Separate doctor authentication (**doctor guard**)
- Dedicated doctor login page (styled like admin login)
- **Remember Me** supported for doctor login
- Doctor dashboard features:
  - Displays only the logged-in doctor’s appointments
  - Appointment analytics charts:
    - **Pending / Confirmed / Cancelled**
  - Latest 4 appointments shown as a summary
- Doctor appointment management:
  - View appointments
  - Update appointment status
  - Access control enforced (doctor cannot view/edit other doctors’ appointments)

---

## Authentication & Redirect Logic
- Guest users trying to access protected routes are redirected properly:
  - `/admin/*` → `/admin/login`
  - `/doctor/*` → `/doctor/login`
- Logged-in users trying to access guest-only routes are redirected:
  - Admin → `/admin/dashboard`
  - Doctor → `/doctor/dashboard`

---

## Tech Stack
- **Laravel 12**
- **PHP 8.2**
- Blade Templates
- Bootstrap (SB Admin 2)
- MySQL
- Font Awesome
- Chart.js

---

## Technical Implementation
- Organized project structure
- Proper routing and controller separation
- Separate guards for Admin and Doctor
- Database-safe migrations
- Assets and dependencies correctly configured

---

## Installation & Setup

```bash
git clone <repository-url>
cd MediLab-Laravel-Backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
