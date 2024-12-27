<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'rt' => ['nullable', 'string'],
            'rw' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string'],
            'foto' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg',
                'max:10240',
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', // minimal 100x100, maksimal 2000x2000
            ],
        ];
    }
}
