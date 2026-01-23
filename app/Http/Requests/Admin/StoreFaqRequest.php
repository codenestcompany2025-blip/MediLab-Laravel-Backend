<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question'   => ['required', 'string'],
            'answer'     => ['required', 'string'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ];
    }
}
