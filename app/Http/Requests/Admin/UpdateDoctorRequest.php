<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $doctor = $this->route('doctor'); // ممكن يكون Model أو ID
        $doctorId = is_object($doctor) ? $doctor->id : $doctor;

        return [
            'name'          => ['required', 'string', 'max:255'],
            'specialty'     => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],
            'email'         => ['nullable', 'email', 'unique:doctors,email,' . $doctorId],
            'password'      => ['nullable', 'string', 'min:8'],
            'bio'           => ['nullable', 'string'],
            'facebook'      => ['nullable', 'string', 'max:255'],
            'twitter'       => ['nullable', 'string', 'max:255'],
            'instagram'     => ['nullable', 'string', 'max:255'],
            'linkedin'      => ['nullable', 'string', 'max:255'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
