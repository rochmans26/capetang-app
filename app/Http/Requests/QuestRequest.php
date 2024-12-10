<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestRequest extends FormRequest
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
            'nama_quest' => ['required', 'string', 'min:3', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:255', 'min:3'],
            'waktu_mulai' => ['required', 'date'],
            'waktu_berakhir' => ['required', 'date'],
            'point' => ['nullable', 'integer', 'min:0'],
        ];

        if ($this->isMethod('post')) {
            $rules['nama_quest'] = ['required', 'string', 'min:3', 'max:255', 'unique:quest,nama_quest'];
        }

        if ($this->isMethod('put')) {
            $id = $this->route('quest') ?? $this->id;
            $rules['nama_quest'] = ['required', 'string', 'min:3', 'max:255', 'unique:quest,nama_quest,' . $id];
        }

        return $rules;
    }
}
