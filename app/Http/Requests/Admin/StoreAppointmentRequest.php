<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255'],
            'phone'          => ['required', 'string', 'max:50'],
            'appointment_at' => ['required', 'date_format:Y-m-d H:i'],
            'department_id'  => ['required', 'exists:departments,id'],
            'doctor_id'      => ['nullable', 'exists:doctors,id'],
            'message'        => ['nullable', 'string'],
            'status'         => ['nullable', 'string', 'max:50'], 
        ];
    }
}
