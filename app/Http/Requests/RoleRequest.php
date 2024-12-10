<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nama_role' => ['required', 'string', 'min:3', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:255', 'min:3'],
        ];

        if ($this->isMethod('post')) {
            $rules['nama_role'] = ['required', 'string', 'min:3', 'max:255', 'unique:role,nama_role'];
        }

        if ($this->isMethod('put')) {
            $id = $this->route('role') ?? $this->id;
            $rules['nama_role'] = ['required', 'string', 'min:3', 'max:255', 'unique:role,nama_role,' . $id];
        }

        return $rules;
    }
}
