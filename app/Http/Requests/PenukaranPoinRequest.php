<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenukaranPoinRequest extends FormRequest
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
            'id_user' => ['required', 'exists:users,id'],
            'tgl_transaksi' => ['required', 'date'],
            'total_trasaksi' => ['required', 'integer', 'min:0'],
            'status_transaksi' => ['nullable', 'string', 'max:255', 'min:3'],
            'bukti_penyerahan' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg',
                'max:10240',
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', // minimal 100x100, maksimal 2000x2000
            ],
        ];

        return $rules;
    }
}
