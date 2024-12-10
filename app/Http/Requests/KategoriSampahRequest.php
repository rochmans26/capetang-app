<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriSampahRequest extends FormRequest
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
            'nama_kategori' => ['required', 'string', 'min:3', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:255', 'min:3'],
        ];

        if ($this->isMethod('post')) {
            $rules['nama_kategori'] = ['required', 'string', 'min:3', 'max:255', 'unique:kategori_sampah,nama_kategori'];
        }

        if ($this->isMethod('put')) {
            $id = $this->route('kategori_sampah') ?? $this->id;
            $rules['nama_kategori'] = ['required', 'string', 'min:3', 'max:255', 'unique:kategori_sampah,nama_kategori,' . $id];
        }

        return $rules;
    }
}
