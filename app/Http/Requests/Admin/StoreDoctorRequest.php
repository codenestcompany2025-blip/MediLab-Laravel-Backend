<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'specialty'     => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],
            'email'         => ['nullable', 'email', 'unique:doctors,email'],
            'password'      => ['nullable', 'string', 'min:8'],
            'bio'           => ['nullable', 'string'],
            'facebook'      => ['nullable', 'string', 'max:255'],
            'twitter'       => ['nullable', 'string', 'max:255'],
            'instagram'     => ['nullable', 'string', 'max:255'],
            'linkedin'      => ['nullable', 'string', 'max:255'],
            'image'         => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
