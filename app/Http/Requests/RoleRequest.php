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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'max:255', 'min:3'],
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,id',
        ];

        if ($this->isMethod('post')) {
            $rules['name'] = ['required', 'string', 'min:3', 'max:255', 'unique:roles,name'];
        }

        if ($this->isMethod('put')) {
            $id = $this->route('role') ?? $this->id;
            $rules['name'] = ['required', 'string', 'min:3', 'max:255', 'unique:roles,name,' . $id];
        }

        return $rules;
    }
}
