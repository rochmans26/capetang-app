<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'nama_item' => ['required', 'string', 'min:3', 'max:255'],
            'stok_item' => ['required', 'integer', 'min:0'],
            'deskripsi_item' => ['nullable', 'string', 'max:255', 'min:3'],
            'point_item' => ['nullable', 'integer', 'min:0'],
            'foto_item' => [
                'nullable',
                'file',
                'mimes:png,jpg,jpeg',
                'max:10240',
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', // minimal 100x100, maksimal 2000x2000
            ],
        ];

        if ($this->isMethod('post')) {
            $rules['nama_item'] = ['required', 'string', 'min:3', 'max:255', 'unique:item,nama_item'];
        }

        if ($this->isMethod('put')) {
            $id = $this->route('item') ?? $this->id;
            $rules['nama_item'] = ['required', 'string', 'min:3', 'max:255', 'unique:item,nama_item,' . $id];
        }

        return $rules;
    }
}
