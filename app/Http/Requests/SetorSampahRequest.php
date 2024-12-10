<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetorSampahRequest extends FormRequest
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
            'tgl_setor_sampah' => ['required', 'date'],
            'id_user' => ['required', 'exists:users,id'],
            'id_kategori' => ['required', 'exists:kategori_sampah,id'],
            'berat_sampah' => ['required', 'numeric', 'min:0'],
            'bukti_penyerahan' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg',
                'max:10240',
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', // minimal 100x100, maksimal 2000x2000
            ],
            'point' => ['nullable', 'integer', 'min:0'],
        ];

        return $rules;
    }
}
