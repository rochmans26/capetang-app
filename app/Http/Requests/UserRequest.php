<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['nullable', 'string'],
            'role' => ['required', 'exists:roles,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'min:8', 'max:255'],
            'password_confirmation' => ['required', 'string', 'same:password', 'min:8', 'max:255'],
            'rt' => ['nullable', 'string'],
            'rw' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string'],
            'foto' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg',
                'max:10240',
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', // minimum 100x100, maximum 2000x2000
            ],
        ];

        if ($this->isMethod('put')) {
            $id = $this->route('kelola_pengguna') ?? $this->id;
            $rules['email'] = ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class . ',email,' . $id];
            $rules['password'] = ['nullable', 'confirmed', Rules\Password::defaults(), 'min:8', 'max:255'];
            $rules['password_confirmation'] = ['nullable', 'string', 'same:password', 'min:8', 'max:255'];
        }

        return $rules;
    }
}
