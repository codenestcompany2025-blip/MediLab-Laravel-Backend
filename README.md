# MediLab – Laravel Admin Dashboard & Frontend Website
MediLab is a full-stack medical website built with **Laravel**, featuring a modern **Admin Dashboard** and a public **One-Page Frontend Website** fully aligned with the original MediLab Bootstrap template.

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

## Appointment Feature
- Appointment form submits via POST
- Data is stored in the database
- Success message displayed after submission
- Redirects back to the Appointment section

---

## Contact Feature
- Contact form submits via POST
- Messages are stored in the database
- Messages are sent via email
- Success message displayed
- Redirects back to the Contact section

---

## Admin Panel
- Separate admin authentication (custom guard)
- Secure admin login system
- Dashboard interface
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

## Tech Stack
- **Laravel 12**
- **PHP 8.2**
- Blade Templates
- Bootstrap
- MySQL
- Font Awesome

---

## Technical Implementation
- Organized project structure
- Proper routing and controller separation
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
php artisan storage:link
php artisan serve
